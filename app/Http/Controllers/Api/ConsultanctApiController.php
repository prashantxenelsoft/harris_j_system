<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultancy;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Consultant;
use App\Models\UserManagment;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\TestMail;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
class ConsultanctApiController extends Controller
{
    public function apiUpdateBasicDetailsConsultant(Request $request)
    {
        $userData = User::findOrFail($request->user_id);
        $consultant = Consultant::where('login_email', $userData->email)->first();
        if (!$consultant) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Consultant not found for this user.',
                ],
                404
            );
        }
        $consultant->fill($request->only(['first_name', 'middle_name', 'last_name', 'dob', 'citizen', 'nationality', 'address_by_user', 'mobile_number']));
        if ($request->hasFile('profile_image')) {
            if ($consultant->profile_image && file_exists(public_path('storage/' . $consultant->profile_image))) {
                unlink(public_path('storage/' . $consultant->profile_image));
            }
            $image = $request->file('profile_image');
            $fileName = time() . '_profile_' . $image->getClientOriginalName();
            $image->storeAs('consultant', $fileName, 'public');
            $consultant->profile_image = 'consultant/' . $fileName;
        }
        if ($request->hasFile('resume_file')) {
            if ($consultant->resume_file && file_exists(public_path('storage/' . $consultant->resume_file))) {
                unlink(public_path('storage/' . $consultant->resume_file));
            }
            $resume = $request->file('resume_file');
            $fileName = time() . '_resume_' . $resume->getClientOriginalName();
            $resume->storeAs('consultant', $fileName, 'public');
            $consultant->resume_file = 'consultant/' . $fileName;
        }
        $consultant->save();
        return response()->json([
            'status' => true,
            'message' => 'Consultant details updated successfully',
            'data' => $consultant,
        ]);
    }
    public function getDashboardTimelineData(Request $request)
    {
        $user = $request->user();
        $rawRecords = DB::table('consultant_dashboard')
            ->where('user_id', $user->id)
            ->where('type', 'timesheet')
            ->get();
        $grouped = [];
        foreach ($rawRecords as $item) {
            $record = json_decode($item->record, true);
            $applyDate = trim($record['applyOnCell'] ?? '');
            if (empty($applyDate)) {
                continue;
            }
            try {
                $dates = [];
                if (!empty($record['date']) && str_contains($record['date'], 'to')) {
                    [$from, $to] = explode('to', $record['date']);
                    $start = \Carbon\Carbon::createFromFormat('d / m / Y', trim($from));
                    $end = \Carbon\Carbon::createFromFormat('d / m / Y', trim($to));
                    $dates = \Carbon\CarbonPeriod::create($start, $end);
                    $record['date_range'] = $record['date'];
                    unset($record['date']);
                } else {
                    $dates[] = \Carbon\Carbon::createFromFormat('d / m / Y', $applyDate);
                }
                if (!empty($record['certificate_path'])) {
                    $filename = str_replace('storage/app/public/', '', $record['certificate_path']);
                    $record['certificate_path'] = url('public/storage/' . ltrim($filename, '/'));
                }
                if (isset($record['leaveType']) && $record['leaveType'] === 'Custom AL') {
                    $record['leaveType'] = 'AL';
                }
                foreach ($dates as $date) {
                    if ($date->isFuture()) {
                        continue;
                    }
                    $monthKey = $date->format('Y-m');
                    $day = $date->day;
                    if (!isset($grouped[$monthKey])) {
                        $grouped[$monthKey] = [];
                    }
                    $grouped[$monthKey][$day] = [
                        'id' => $item->id,
                        'user_id' => $item->user_id,
                        'client_id' => $item->client_id,
                        'type' => $item->type,
                        'details' => $record,
                        'status' => $item->status,
                    ];
                }
            } catch (\Exception $e) {
                continue;
            }
        }
        $finalData = [];
        foreach ($grouped as $month => $days) {
            $carbon = \Carbon\Carbon::createFromFormat('Y-m', $month);
            $daysInMonth = $carbon->daysInMonth;
            $daysList = [];
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $fullDate = $carbon
                    ->copy()
                    ->day($i)
                    ->format('d / m / Y');
                $fullCarbonDate = \Carbon\Carbon::createFromFormat('d / m / Y', $fullDate);
                if ($fullCarbonDate->isFuture()) {
                    continue;
                }
                if (isset($days[$i])) {
                    if (empty($days[$i]['details']['date'])) {
                        $days[$i]['details']['date'] = $fullDate;
                    }
                    $daysList[] = [
                        'day' => $i,
                        'id' => $days[$i]['id'],
                        'user_id' => $days[$i]['user_id'],
                        'client_id' => $days[$i]['client_id'],
                        'type' => $days[$i]['type'],
                        'details' => $days[$i]['details'],
                        'status' => $days[$i]['status'],
                    ];
                } else {
                    $daysList[] = [
                        'day' => $i,
                        'id' => null,
                        'user_id' => $user->id,
                        'client_id' => null,
                        'type' => 'timesheet',
                        'details' => [
                            'date' => $fullDate,
                            'workingHours' => 8,
                            'leaveType' => null,
                            'date_range' => null,
                            'applyOnCell' => null,
                            'certificate_path' => null,
                        ],
                        'status' => 'AutoFilled',
                    ];
                }
            }
            if (!empty($daysList)) {
                $finalData[] = [
                    'month' => $carbon->format('F Y'),
                    'start_date' => $carbon->startOfMonth()->toDateString(),
                    'end_date' => $carbon->endOfMonth()->toDateString(),
                    'days' => $daysList,
                ];
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Timeline data compiled successfully.',
            'data' => $finalData,
        ]);
    }

    public function getConsultantAllDetails(Request $request)
    {
        $user = auth()->user();
        $month = $request->input('month');
        $year = $request->input('year');

        if (!$user || !$month || !$year) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Missing required parameters.',
                ],
                400
            );
        }

        $data = DB::table('consultant_dashboard')
            ->where('user_id', $user->id)
            ->where('type', 'timesheet')
            ->get();

        // === LEAVE LOG ===
        $leaveLog = $data
            ->filter(function ($item) use ($month, $year) {
                $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;
                if (!isset($record['applyOnCell']) || !isset($record['leaveType'])) {
                    return false;
                }

                $parts = explode(' / ', $record['applyOnCell']);
                return count($parts) === 3 && $parts[1] == str_pad($month, 2, '0', STR_PAD_LEFT) && $parts[2] == $year;
            })
            ->map(function ($item) {
                $item->record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

                $dateField = $item->record['date'] ?? '';
                $applyOnCell = $item->record['applyOnCell'] ?? '';

                $from = $to = $applyOnCell;
                $count = 1;

                if ($dateField && Str::contains($dateField, 'to')) {
                    try {
                        [$start, $end] = array_map('trim', explode('to', $dateField));
                        $from = $start;
                        $to = $end;

                        $startDate = Carbon::createFromFormat('d / m / Y', $start);
                        $endDate = Carbon::createFromFormat('d / m / Y', $end);
                        $count = $startDate->diffInDays($endDate) + 1;
                    } catch (\Exception $e) {
                    }
                } elseif ($dateField) {
                    $from = $to = $dateField;
                    $count = 1;
                } elseif ($applyOnCell) {
                    $from = $to = $applyOnCell;
                    $count = 1;
                }

                $item->record['from'] = $from;
                $item->record['to'] = $to;
                $item->record['count'] = "$count days";

                return $item;
            })
            ->values();

        // === FORECASTED HOURS ===
        $forecastedDays = 0;
        $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::createFromDate($year, $month, $day);
            if (!$date->isWeekend()) {
                $forecastedDays++;
            }
        }
        $forecastedHours = $forecastedDays * 8;

        // === LOGGED HOURS ===
        $loggedHours = $data->reduce(function ($carry, $item) use ($month, $year) {
            $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

            if (!isset($record['applyOnCell']) || !isset($record['workingHours'])) {
                return $carry;
            }

            $parts = explode(' / ', $record['applyOnCell']);
            if (count($parts) !== 3) {
                return $carry;
            }

            if ($parts[1] == str_pad($month, 2, '0', STR_PAD_LEFT) && $parts[2] == $year) {
                return $carry + (is_numeric($record['workingHours']) ? (float) $record['workingHours'] : 0);
            }

            return $carry;
        }, 0);

        $timelineItems = [];
        $labelMap = [
            'PH' => 'Public Holiday',
            'ML' => 'Medical Leave',
            'AL' => 'Annual Leave',
            'UL' => 'Unpaid Leave',
            'PDO' => 'Paid day off',
            'Custom COMP-OFF' => 'Comp off',
            'pay_off' => 'Pay off',
            'comp_off' => 'Comp off',
            'ignore' => 'Ignore',
        ];

        foreach ($data as $entry) {
            $record = is_string($entry->record) ? json_decode($entry->record, true) : $entry->record;
            $leaveType = $record['leaveType'] ?? null;
            $subType = $record['type'] ?? null;
            $workingHours = $record['workingHours'] ?? null;
            $extraHours = $record['extraHours'] ?? null;
            $leaveHourId = $record['leaveHourId'] ?? null;
            $applyOnCell = $record['applyOnCell'] ?? null;
            $dateRange = $record['date'] ?? '';

            if (!$leaveType && !$subType) {
                continue;
            }

            $leaveShort = '';
            if ($leaveHourId === 'fHalfDay') {
                $leaveShort = 'HD1';
            } elseif ($leaveHourId === 'sHalfDay') {
                $leaveShort = 'HD2';
            } elseif ($leaveHourId === 'customDay') {
                $leaveShort = 'custom';
            }

            $topLabel = strtoupper($leaveType ?? ucfirst(str_replace('_', ' ', $subType)));
            $mainLabel = $labelMap[$leaveType] ?? ($labelMap[$subType] ?? null);
            $badgeText = $leaveType ? ($leaveShort ? "$leaveType $leaveShort" : $leaveType) : null;

            $dates = [];

            if ($dateRange && Str::contains($dateRange, 'to')) {
                try {
                    [$start, $end] = array_map('trim', explode('to', $dateRange));
                    $startDate = \Carbon\Carbon::createFromFormat('d / m / Y', $start);
                    $endDate = \Carbon\Carbon::createFromFormat('d / m / Y', $end);
                    while ($startDate->lte($endDate)) {
                        $dates[] = $startDate->copy();
                        $startDate->addDay();
                    }
                } catch (\Exception $e) {
                }
            } elseif ($applyOnCell) {
                try {
                    $dates[] = \Carbon\Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                } catch (\Exception $e) {
                }
            }

            foreach ($dates as $date) {
                if (in_array($date->dayOfWeek, [0, 6])) {
                    continue;
                } // Skip weekends
                if ($date->month != $month || $date->year != $year) {
                    continue;
                } // Filter by current month/year

                $timelineItems[] = [
                    'date' => $date->format('Y-m-d'),
                    'formatted' => $date->format('D, d M'),
                    'topLabel' => $topLabel,
                    'mainLabel' => $mainLabel,
                    'badge' => $badgeText,
                    'workingHours' => $workingHours,
                    'extraHours' => $extraHours,
                ];
            }
        }

        $extra_time_log = $data
            ->filter(function ($item) use ($month, $year) {
                $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

                if (!isset($record['type'], $record['applyOnCell'])) {
                    return false;
                }

                $parts = explode(' / ', $record['applyOnCell']);
                if (count($parts) !== 3) {
                    return false;
                }

                return $parts[1] == str_pad($month, 2, '0', STR_PAD_LEFT) && $parts[2] == $year && in_array($record['type'], ['comp_off', 'pay_off', 'ignore']);
            })
            ->map(function ($item) {
                $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

                $labelMap = [
                    'comp_off' => ['label' => 'Comp - Off', 'color' => '#d35400'],
                    'pay_off' => ['label' => 'Pay - Off', 'color' => '#2980b9'],
                    'ignore' => ['label' => 'Ignored', 'color' => '#7f8c8d'],
                ];

                $type = $record['type'];
                $label = $labelMap[$type]['label'] ?? 'Unknown';
                $color = $labelMap[$type]['color'] ?? '#000000';

                return [
                    'date' => $record['applyOnCell'] ?? '--/--/----',
                    'type' => $type,
                    'label' => $label,
                    // 'color' => $color,
                    'hours' => str_pad($record['extraHours'] ?? '0', 2, '0', STR_PAD_LEFT) . ' : 00',
                ];
            })
            ->values();

        $pay_off_log = $data
            ->filter(function ($item) use ($month, $year) {
                $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

                if (!isset($record['type'], $record['applyOnCell']) || $record['type'] !== 'pay_off') {
                    return false;
                }

                $parts = explode(' / ', $record['applyOnCell']);
                return count($parts) === 3 && $parts[1] == str_pad($month, 2, '0', STR_PAD_LEFT) && $parts[2] == $year;
            })
            ->map(function ($item) {
                $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

                return [
                    'date' => $record['applyOnCell'] ?? '--/--/----',
                    'hours' => str_pad($record['extraHours'] ?? '0', 2, '0', STR_PAD_LEFT) . ' : 00',
                ];
            })
            ->values();

        $comp_off_log = [];

        foreach ($data as $item) {
            $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

            if (($record['leaveType'] ?? '') !== 'Custom COMP-OFF') {
                continue;
            }

            $leaveHour = $record['leaveHour'] ?? '';
            $extraHours = isset($record['extraHours']) ? (int) $record['extraHours'] : 0;
            $applyOnCell = $record['applyOnCell'] ?? '';
            $dateRange = $record['date'] ?? '';

            $subLabel = '';
            if (Str::contains($leaveHour, 'HD1')) {
                $subLabel = 'HD1';
            } elseif (Str::contains($leaveHour, 'HD2')) {
                $subLabel = 'HD2';
            }

            $label = 'Comp - Off' . ($subLabel ? " $subLabel" : '');

            $dates = [];

            if ($dateRange && Str::contains($dateRange, 'to')) {
                try {
                    [$start, $end] = array_map('trim', explode('to', $dateRange));
                    $startDate = Carbon::createFromFormat('d / m / Y', $start);
                    $endDate = Carbon::createFromFormat('d / m / Y', $end);
                    while ($startDate->lte($endDate)) {
                        $dates[] = $startDate->copy();
                        $startDate->addDay();
                    }
                } catch (\Exception $e) {
                }
            } elseif ($applyOnCell) {
                try {
                    $dates[] = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                } catch (\Exception $e) {
                }
            }

            foreach ($dates as $date) {
                if (in_array($date->dayOfWeek, [0, 6])) {
                    continue;
                } // skip weekends
                if ($date->month != $month || $date->year != $year) {
                    continue;
                }

                $comp_off_log[] = [
                    'date' => $date->format('D, d M'),
                    'label' => $label,
                    'hours' => $extraHours > 0 ? str_pad($extraHours, 2, '0', STR_PAD_LEFT) . ' : 00' : null,
                ];
            }
        }

        $monthGroups = [];

        foreach ($data as $item) {
            $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;
            if (!isset($record['applyOnCell'])) {
                continue;
            }

            $parts = explode(' / ', $record['applyOnCell']);
            if (count($parts) !== 3) {
                continue;
            }

            [$day, $monthStr, $year] = $parts;
            $monthKey = $year . '-' . str_pad($monthStr, 2, '0', STR_PAD_LEFT);
            $monthGroups[$monthKey][] = strtolower(trim($item->status ?? ''));
        }

        $monthlyStatus = [];

        foreach ($monthGroups as $monthKey => $statuses) {
            if (in_array('draft', $statuses)) {
                $monthlyStatus[$monthKey] = 'Draft';
            } elseif (count(array_unique($statuses)) === 1) {
                $monthlyStatus[$monthKey] = ucfirst($statuses[0]);
            } else {
                $monthlyStatus[$monthKey] = 'Mixed';
            }
        }

        // ✅ Get only latest 6 submitted
        ksort($monthlyStatus);
        $submittedOnly = array_filter($monthlyStatus, fn($s) => strtolower($s) === 'submitted');
        $submittedOnly = array_slice($submittedOnly, -6, 6, true);

        // ✅ Format final structure
        $get_copies = [];

        foreach ($submittedOnly as $monthKey => $status) {
            try {
                $monthTitle = \Carbon\Carbon::createFromFormat('Y-m', $monthKey)->format('F - Y');
            } catch (\Exception $e) {
                $monthTitle = $monthKey;
            }

            $get_copies[] = [
                'label' => 'Timesheet Overview',
                'month_title' => $monthTitle,
                'month_key' => $monthKey,
                'status' => ucfirst($status),
                'download_url' => url('/download-pdf'), // ✅ Update if dynamic
            ];
        }

        // === RESPONSE ===
        return response()->json([
            'status' => true,
            'leave_log' => $leaveLog,
            'work_log' => [
                'forecasted_hours' => $forecastedHours,
                'logged_hours' => round($loggedHours, 2),
            ],
            'timesheet_overview' => $timelineItems,
            'extra_time_log' => $extra_time_log,
            'pay_off_log' => $pay_off_log,
            'comp_off_log' => $comp_off_log,
            'get_copies' => $get_copies,
        ]);
    }

    public function ConsultantFeedBack(Request $request, $id = null)
    {
        $method = $request->method();
        $uri = $request->route()->uri(); // gets the route pattern like 'consultant/feedback/store'
        if ($method === 'POST' && $uri === 'api/consultant/feedback/store') {
            // Create
            $request->validate([
                'user_id' => 'required|integer',
                'message' => 'required|string|max:1000',
            ]);

            DB::table('feedbacks')->insert([
                'sender_id' => $request->user_id,
                'message' => $request->message,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['success' => true, 'message' => 'Feedback submitted successfully.']);
        }

       if ($method === 'GET' && $uri === 'api/consultant/feedback/all') {
            // Only get feedbacks where sender_id matches the given user
            $senderId = $request->user_id; 

            $feedbacks = DB::table('feedbacks')
                ->where('sender_id', $senderId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json($feedbacks);
        }

        if ($method === 'PUT' && $uri === 'api/consultant/feedback/update/{id}') {
            // Update
            $request->validate([
                'message' => 'required|string|max:1000',
            ]);

            DB::table('feedbacks')->where('id', $id)->update([
                'message' => $request->message,
                'updated_at' => now(),
            ]);

            return response()->json(['success' => true, 'message' => 'Feedback updated successfully.']);
        }

        if ($method === 'DELETE' && $uri === 'api/consultant/feedback/delete/{id}') {
            // Delete
            DB::table('feedbacks')->where('id', $id)->delete();
            return response()->json(['success' => true, 'message' => 'Feedback deleted successfully.']);
        }

        return response()->json(['error' => 'Unsupported route or method.'], 404);
    }
    public function getDashboard(Request $request)
    {
        $user = $request->user();

        // Fetch timesheet data
        $dataTimesheet = DB::table('consultant_dashboard')
            ->where('user_id', $user->id)
            ->where('type', 'timesheet')
            ->get();

        // Timesheet status summary
        $total = $dataTimesheet->count();
        $submitted = $dataTimesheet->where('status', 'submitted')->count();
        $approved = $dataTimesheet->where('status', 'approved')->count();
        $rejected = $dataTimesheet->where('status', 'rejected')->count();

        // Working hours calculation
        $workingHourRows = 0;
        $totalWorkingHours = 0;

        foreach ($dataTimesheet as $item) {
            $record = json_decode($item->record ?? '{}', true);

            if (isset($record['workingHours']) && is_numeric($record['workingHours'])) {
                $workingHourRows++;
                $totalWorkingHours += (float) $record['workingHours'];
            }
        }

        $totalForecastedHours = $workingHourRows * 8;

        // Fetch claims
        $claims = DB::table('consultant_dashboard')
            ->where('user_id', $user->id)
            ->where('type', 'claims')
            ->get()
            ->map(function ($item) {
                return [
                    'claim_no' => json_decode($item->record, true)['claim_no'] ?? 'N/A',
                    'status' => $item->status ?? 'draft',
                    'record' => json_decode($item->record, true)
                ];
            });

        // Final response
        return response()->json([
            'status' => true,
            'message' => 'Dashboard data fetched successfully.',
            'user' => $user,
            'timesheet_summary' => [
                'total_timesheets' => $total,
                'submitted' => $submitted,
                'approved' => $approved,
                'rejected' => $rejected
            ],
            'working_log' => [
                'hours_forecasted' => $totalForecastedHours,
                'hours_logged' => $totalWorkingHours
            ],
            'claims_summary' => $claims
        ]);
    }


    public function addConsultantData(Request $request)
    {
        $records = json_decode($request->record, true); 
        $records['time'] = now()->format('h:i A'); 
        $request->merge(['record' => json_encode($records)]);
        if (!is_array($records)) {
        return response()->json(['success' => false, 'message' => 'Invalid record format.']);
        }
        if (array_keys($records) !== range(0, count($records) - 1)) {
            $records = [$records];
        }
        $type = $request->type;
        $status = $request->status ?? 'Draft';
        $userId = $request->user_id;
        foreach ($records as $recordData) {
            $applyOnCell = $recordData['applyOnCell'] ?? null;
            $incomingExpenseType = $recordData['expenseType'] ?? null;
            if (!empty($recordData['date']) && strpos($recordData['date'], 'to') !== false) {
                $rangeParts = explode(' to ', $recordData['date']);
                if (count($rangeParts) === 2) {
                    try {
                        $start = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[0]));
                        $end = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[1]));
                        while ($start->lte($end)) {
                            $formattedDate = $start->format('d / m / Y');
                            $rowsToDelete = DB::table('consultant_dashboard')
                                ->where('type', 'timesheet')
                                ->where('user_id', $userId)
                                ->whereJsonContains('record->applyOnCell', $formattedDate)
                                ->get();
                            foreach ($rowsToDelete as $row) {
                                $decoded = json_decode($row->record, true);
                                $imagePath = $decoded['certificate_path'] ?? null;
                                if ($imagePath && file_exists(base_path($imagePath))) {
                                    unlink(base_path($imagePath));
                                }
                                DB::table('consultant_dashboard')->where('id', $row->id)->delete();
                            }
                            $start->addDay();
                        }
                    } catch (\Exception $e) {
                        \Log::error("Failed to delete overlapping workingHours: " . $e->getMessage());
                    }
                }
            }
            $existingRecords = DB::table('consultant_dashboard')
                ->where('type', $type)
                ->where('user_id', $userId)
                ->get();
            $match = null;
            foreach ($existingRecords as $row) {
                $decoded = json_decode($row->record, true);
                if (
                    ($type === 'timesheet' && !empty($decoded['applyOnCell']) && $decoded['applyOnCell'] === $applyOnCell) ||
                    ($type === 'claims' && !empty($decoded['expenseType']) && $decoded['expenseType'] === $incomingExpenseType && !empty($decoded['applyOnCell']) && $decoded['applyOnCell'] === $applyOnCell)
                ) {
                    $match = $row;
                    break;
                }
            }
            $oldImagePath = $match ? (json_decode($match->record, true)['certificate_path'] ?? null) : null;
            if ($request->hasFile('certificate')) {
                if ($oldImagePath && file_exists(base_path($oldImagePath))) {
                    unlink(base_path($oldImagePath));
                }
                $image = $request->file('certificate');
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('consultant', $fileName);
                $recordData['certificate_path'] = 'storage/app/public/consultant/' . $fileName;
            } elseif (!$request->hasFile('certificate') && !$match) {
                $recordData['certificate_path'] = null;
            } elseif (!$request->hasFile('certificate') && $match) {
                $recordData['certificate_path'] = $oldImagePath;
            }
            if ($match) {
                // 🛡️ Prevent submitted records from being reverted to Draft
                $finalStatus =  $status;
            
            // Step 1: Fetch existing record first
                $existing = DB::table('consultant_dashboard')->where('id', $match->id)->first();

                if ($existing) {
                    $existingRecord = json_decode($existing->record, true) ?? [];

                    // Step 2: Preserve original claim_no if it exists
                    if (isset($existingRecord['claim_no'])) {
                        $recordData['claim_no'] = $existingRecord['claim_no'];
                    }

                    // Step 3: Save updated record
                    DB::table('consultant_dashboard')
                        ->where('id', $match->id)
                        ->update([
                            'record' => json_encode($recordData),
                            'client_id' => $request->client_id,
                            'client_name' => $request->client_name,
                            'status' => $finalStatus,
                            'updated_at' => now()
                        ]);
                }

            
                // ✅ If this record is marked as Submitted, then apply it to all records of the same month
                if ($finalStatus === 'Submitted') {
                    try {
                        $applyDate = \Carbon\Carbon::createFromFormat('d / m / Y', $applyOnCell);
                        $month = $applyDate->format('m');
                        $year = $applyDate->format('Y');
            
                        $allSameMonth = DB::table('consultant_dashboard')
                            ->where('type', $type)
                            ->where('user_id', $request->user_id)
                            ->get();
            
                            foreach ($allSameMonth as $row) {
                                $decoded = json_decode($row->record, true);
                                $cellDate = $decoded['applyOnCell'] ?? null;
                            
                                if ($cellDate) {
                                    try {
                                        $cellDateCarbon = \Carbon\Carbon::createFromFormat('d / m / Y', trim($cellDate));
                                        if ($cellDateCarbon->isSameMonth($applyDate)) {
                                            DB::table('consultant_dashboard')
                                                ->where('id', $row->id)
                                                ->update([
                                                    'status' => 'Submitted',
                                                    'updated_at' => now()
                                                ]);
                                        }
                                    } catch (\Exception $e) {
                                        \Log::warning("Invalid applyOnCell format in row ID {$row->id}");
                                    }
                                }
                            }
                            
                    } catch (\Exception $e) {
                        \Log::error("Failed to update same month records to Submitted: " . $e->getMessage());
                    }
                    DB::table('consultant_dashboard')->where('id', $match->id)->update([
                        'record' => json_encode($recordData),
                        'client_id' => $request->client_id,
                        'client_name' => $request->client_name,
                        'status' => $finalStatus,
                        'updated_at' => now()
                    ]);
                }
            } else {
                DB::table('consultant_dashboard')->insert([
                    'type' => $type,
                    'record' => json_encode($recordData),
                    'user_id' => $userId,
                    'client_id' => $request->client_id,
                    'client_name' => $request->client_name,
                    'status' => $status,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            try {
                $applyDate = \Carbon\Carbon::createFromFormat('d / m / Y', $applyOnCell);
                $month = $applyDate->format('m');
                $year = $applyDate->format('Y');
                $sameMonthRecords = DB::table('consultant_dashboard')
                    ->where('type', $type)
                    ->where('user_id', $userId)
                    ->get();
                foreach ($sameMonthRecords as $row) {
                    $decoded = json_decode($row->record, true);
                    $cellDate = $decoded['applyOnCell'] ?? null;
                    if ($cellDate) {
                        try {
                            $cellDateCarbon = \Carbon\Carbon::createFromFormat('d / m / Y', trim($cellDate));
                            if ($cellDateCarbon->format('m') === $month && $cellDateCarbon->format('Y') === $year) {
                                DB::table('consultant_dashboard')->where('id', $row->id)->update([
                                    'status' => $status,
                                    'updated_at' => now()
                                ]);
                            }
                        } catch (\Exception $e) {
                            \Log::warning("Invalid applyOnCell format in row ID {$row->id}");
                        }
                    }
                }
            } catch (\Exception $e) {
                \Log::error("Month status sync failed: " . $e->getMessage());
            }
        }
        if ($status === 'Submitted') {

            $to = $request->reporting_manager_email;
            $cc = $request->corporate_email;
            if (!empty($to)) {

                try {

                    $consultant = \App\Models\Consultant::where('user_id', $userId)->first();

                    $token = $consultant->token ?? null;

                    $selectedYear = $request->input('selectedYear');

                    $selectedMonth = $request->input('selectedMonth');
        
                    // Generate PDF for record

                    $data = [

                        'type' => 'Timesheet Submission',

                        'token' => $token,

                        'consultant' => $consultant,

                        'client' => DB::table('clients')->where('id', $consultant->client_id)->first(),

                        'consultancy' => DB::table('users')->where('id', $consultant->client_id)->first(),

                        'dashboards' => DB::table('consultant_dashboard')

                            ->where('user_id', $consultant->user_id)

                            ->where('type', 'timesheet')

                            ->where('status', 'Submitted')

                            ->get(),

                        'selectedYear' => $selectedYear,

                        'selectedMonth' => $selectedMonth,

                        'totalWorkingHours' => 0,

                        'isPdf' => true

                    ];
        
                    foreach ($data['dashboards'] as $dashboard) {

                        $record = json_decode($dashboard->record, true);

                        if (!empty($record['workingHours'])) {

                            $data['totalWorkingHours'] += floatval($record['workingHours']);

                        }

                    }
        
                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('emails.reporting_manager', $data);
        
                    $fileName = 'timesheet_' . $consultant->id . '_' . time() . '.pdf';

                    $folder = storage_path('app/public/consultant/timesheets');

                    if (!\File::exists($folder)) {

                        \File::makeDirectory($folder, 0755, true);

                    }
        
                    $filePath = $folder . '/' . $fileName;

                    file_put_contents($filePath, $pdf->output());

                    $pdfLink = 'storage/consultant/timesheets/' . $fileName;
        
                    $givenBy = !empty($givenBy) ? $givenBy : null;
        
                    DB::table('remarks')->insert([

                        'remark' => 'Harris J system update - Successfully submitted timesheet. You can track request via status bar.',

                        'pdf_link' => $pdfLink,

                        'month_of' => $selectedMonth."-".$selectedYear,

                        'consultant_id' => 1,

                        'given_by' => $givenBy,

                        'given_by_type' => 'system',

                        'created_at' => now(),

                        'updated_at' => now()

                    ]);
        
        
                    // Send mail

                    \Mail::to($to)

                        ->cc(!empty($cc) ? [$cc] : [])

                        ->send(new \App\Mail\ReportingManagerMail(

                            'Timesheet Submitted',

                            'Consultant has submitted their record.',

                            $token,

                            $selectedYear,

                            $selectedMonth

                        ));

                } catch (\Exception $e) {

                    \Log::error("Mail sending failed to Reporting Manager: " . $e->getMessage());

                    return;

                }

            }

        }
        return response()->json(['success' => true, 'message' => 'Data saved successfully!']);
    }

}
