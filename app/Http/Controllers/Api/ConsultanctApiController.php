<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultancy;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Consultant;
use App\Mail\TimesheetStatusMail;
use App\Models\UserManagment;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Facades\Log;
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

    public function apiGetBasicDetailsConsultant(Request $request)
    {
        $user = auth()->user();
        
         $consultantData = DB::table('consultants')->where('user_id', $user->id)->first();
        if (!$consultantData) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not found.',
                ],
                400
            );
        }else{
             return response()->json([
                'success' => true,
                'message' => 'Data found successfully.',
                'data' => $consultantData,
            ]);
        }

    }
    public function getDashboardTimelineData(Request $request)
    {
        $user = $request->user();

        // Get user's created_at date
        $userCreatedAt = \Carbon\Carbon::parse($user->created_at)->startOfDay();
        $today = now()->startOfDay();

        $rawRecords = DB::table('consultant_dashboard')
        ->where('user_id', $user->id)
        ->where('type', 'timesheet')
        ->get();

        $grouped = [];

        foreach ($rawRecords as $item) {
            $record = json_decode($item->record, true);
            $applyDate = trim($record['applyOnCell'] ?? '');
            if (empty($applyDate)) continue;

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
                    if ($date->isFuture()) continue;

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

        // Build all dates from user's creation date to today
        $fullRange = \Carbon\CarbonPeriod::create($userCreatedAt, $today);
        $fullMonthKeys = collect($fullRange)->map(fn($d) => $d->format('Y-m'))->unique();

        // Ensure empty month blocks exist
        foreach ($fullMonthKeys as $monthKey) {
            if (!isset($grouped[$monthKey])) {
                $grouped[$monthKey] = [];
            }
        }

        $finalData = [];

        foreach ($grouped as $month => $days) {
            $carbon = \Carbon\Carbon::createFromFormat('Y-m', $month);
            $daysInMonth = $carbon->daysInMonth;
            $daysList = [];

            for ($i = 1; $i <= $daysInMonth; $i++) {
                $fullDate = $carbon->copy()->day($i)->format('d / m / Y');
                $fullCarbonDate = \Carbon\Carbon::createFromFormat('d / m / Y', $fullDate);

                if ($fullCarbonDate->lt($userCreatedAt) || $fullCarbonDate->gt($today)) {
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
                        'status' => 'Draft',
                    ];
                }
            }

            if (!empty($daysList)) {
                 $statuses = collect($daysList)->pluck('status')->unique()->values();
                $finalStatus = $statuses->count() === 1 ? $statuses[0] : 'Draft';
                $finalData[] = [
                    'month' => $carbon->format('F Y'),
                    'start_date' => $carbon->startOfMonth()->toDateString(),
                    'end_date' => $carbon->endOfMonth()->toDateString(),
                    'status' => $finalStatus,
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


    public function getDashboardCliamTimelineData(Request $request)
    {
        $user = $request->user();

        $rawRecords = DB::table('consultant_dashboard')
            ->where('user_id', $user->id)
            ->where('type', 'claims')
            ->get();

        $grouped = [];

        foreach ($rawRecords as $item) {
            $record = json_decode($item->record, true);
            $applyDate = trim($record['applyOnCell'] ?? '');
            if (empty($applyDate)) continue;

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
                    if ($date->isFuture()) continue;

                    $monthKey = $date->format('Y-m');
                    $day = $date->day;

                    if (!isset($grouped[$monthKey][$day])) {
                        $grouped[$monthKey][$day] = [];
                    }

                    $grouped[$monthKey][$day][] = [
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

        // Final formatting
        $finalData = [];

        foreach ($grouped as $month => $days) {
            $carbon = \Carbon\Carbon::createFromFormat('Y-m', $month);
            $daysInMonth = $carbon->daysInMonth;
            $daysList = [];

            for ($i = 1; $i <= $daysInMonth; $i++) {
                $fullDate = $carbon->copy()->day($i)->format('d / m / Y');
                $fullCarbonDate = \Carbon\Carbon::createFromFormat('d / m / Y', $fullDate);
                if ($fullCarbonDate->isFuture()) continue;

                if (isset($days[$i])) {
                    foreach ($days[$i] as $entry) {
                        if (empty($entry['details']['date'])) {
                            $entry['details']['date'] = $fullDate;
                        }

                        $daysList[] = [
                            'day' => $i,
                            'id' => $entry['id'],
                            'user_id' => $entry['user_id'],
                            'client_id' => $entry['client_id'],
                            'type' => $entry['type'],
                            'details' => $entry['details'],
                            'status' => $entry['status'],
                        ];
                    }
                }
            }

            if (!empty($daysList)) {
                $statuses = collect($daysList)->pluck('status')->unique()->values();
                $monthStatus = $statuses->count() === 1 ? $statuses[0] : 'Mixed';

                $finalData[] = [
                    'month' => $carbon->format('F Y'),
                    'start_date' => $carbon->startOfMonth()->toDateString(),
                    'end_date' => $carbon->endOfMonth()->toDateString(),
                    'status' => $monthStatus, // ✅ added line
                    'days' => $daysList,
                ];
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'ClaimTimeline data compiled successfully.',
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

        $get_copies = [];

        $user = auth()->user();
        $consultantId = DB::table('consultants')
            ->where('user_id', $user->id)
            ->value('id');

        if ($consultantId) {
            $remarks = DB::table('remarks')
                ->where('consultant_id', $consultantId)
                ->whereNotNull('pdf_link')
                ->where('pdf_link', 'like', '%/timesheets/%') // only timesheet-related
                ->orderByDesc('created_at')
                ->get();

            foreach ($remarks as $remark) {
                $monthKey = $remark->month_of ?? 'Unknown';
                try {
                    [$month, $year] = explode('_', $monthKey);
                    $monthTitle = \Carbon\Carbon::createFromDate($year, $month, 1)->format('F - Y');
                } catch (\Exception $e) {
                    $monthTitle = $monthKey;
                }

                $get_copies[] = [
                    'label' => 'Timesheet Overview',
                    'month_title' => $monthTitle,
                    'month_key' => $monthKey,
                    'status' => 'Submitted',
                    'download_url' => asset($remark->pdf_link),
                ];
            }
        }


        $timesheet_data = DB::table('consultant_dashboard')
        ->where('user_id', $user->id)
        ->where('type', 'timesheet')
        ->get()
        ->filter(function ($item) use ($month, $year) {
            $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;
            $applyOnCell = $record['applyOnCell'] ?? '';
            $parts = explode(' / ', $applyOnCell);
            return count($parts) === 3 &&
                (int)$parts[1] == (int)$month &&
                (int)$parts[2] == (int)$year;
        })
        ->map(function ($item) {
            $item->record = is_string($item->record) ? json_decode($item->record, true) : $item->record;
            return $item;
        })
        ->values();


       $claim_data = DB::table('consultant_dashboard')
        ->where('user_id', $user->id)
        ->where('type', 'claims')
        ->get()
        ->filter(function ($item) use ($month, $year) {
            $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;
            $applyOnCell = $record['applyOnCell'] ?? '';
            $parts = explode(' / ', $applyOnCell);
            return count($parts) === 3 &&
                (int)$parts[1] == (int)$month &&
                (int)$parts[2] == (int)$year;
        })
        ->map(function ($item) {
            $item->record = is_string($item->record) ? json_decode($item->record, true) : $item->record;
            return $item;
        })
        ->values();


        $user = auth()->user();

    // 📌 Get leave_log as a single object
    $leaveLog1 = DB::table('leave_log')
        ->where('user_id', $user->id)
        ->where('year', $year)
        ->first(); // ✅ must use first(), not get()

    // 📊 Filtered timesheet_data as provided
    $timesheet_data1 = DB::table('consultant_dashboard')
        ->where('user_id', $user->id)
        ->where('type', 'timesheet')
        ->get()
        ->filter(function ($item) use ($month, $year) {
            $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;
            $applyOnCell = $record['applyOnCell'] ?? '';
            $parts = explode(' / ', $applyOnCell);
            return count($parts) === 3 &&
                (int)$parts[1] == (int)$month &&
                (int)$parts[2] == (int)$year;
        })
        ->map(function ($item) {
            $item->record = is_string($item->record) ? json_decode($item->record, true) : $item->record;
            return $item;
        })
        ->values();

        $used = ['AL' => 0, 'ML' => 0, 'UL' => 0, 'PDO' => 0, 'Comp Off' => 0];
        $totalUsed = 0;

        foreach ($timesheet_data1 as $entry) {
            $record = $entry->record;
            if (!$record || !isset($record['leaveType'])) continue;

            $originalType = trim($record['leaveType']);
            $workingHours = isset($record['workingHours']) && is_numeric($record['workingHours']) ? floatval($record['workingHours']) : 0;
            $hourId = $record['leaveHourId'] ?? '';
            $applyOnCell = $record['applyOnCell'] ?? '';
            $dateRange = $record['date'] ?? '';

            $mapTypes = [
                'Custom AL' => 'AL',
                'Custom ML' => 'ML',
                'Custom UL' => 'UL',
                'Custom PDO' => 'PDO',
                'Custom COMP-OFF' => 'Comp Off',
            ];
            $type = $mapTypes[$originalType] ?? $originalType;
            $perDayValue = in_array($hourId, ['fHalfDay', 'sHalfDay']) ? 0.5 : 1;
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
                } catch (\Exception $e) {}
            } elseif ($applyOnCell) {
                try {
                    $dates[] = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                } catch (\Exception $e) {}
            }

            foreach ($dates as $d) {
                if (in_array($d->dayOfWeek, [0, 6])) continue;

                if (in_array($type, ['AL', 'ML', 'UL', 'PDO'])) {
                    $used[$type] += $perDayValue;
                    $totalUsed += $perDayValue;
                } elseif ($type === 'Comp Off') {
                    if ($workingHours > 8) {
                        $extra = $workingHours - 8;
                        $compVal = $extra / 8;
                        $used['Comp Off'] += $compVal;
                        $totalUsed += $compVal;
                    } else {
                        $val = $perDayValue;
                        $used['Comp Off'] += $val;
                        $totalUsed += $val;
                    }
                }
            }
        }

        foreach ($used as $key => $val) {
            $used[$key] = number_format($val, 2);
        }
        $totalUsedFormatted = number_format($totalUsed, 2);

        // 🧮 Build leave_summary
        $leave_summary = [
            'Leave Log' => $totalUsedFormatted . ' / ' . ($leaveLog1->assign_total_leave_log ?? 0),
            'AL' => ($used['AL'] ?? '0.00') . ' / ' . ($leaveLog1->assign_al ?? 0),
            'ML' => ($used['ML'] ?? '0.00') . ' / ' . ($leaveLog1->assign_ml ?? 0),
            'UL' => ($used['UL'] ?? '0.00') . ' / ' . ($leaveLog1->assign_ul ?? 0),
            'PDO' => ($used['PDO'] ?? '0.00') . ' / ' . ($leaveLog1->assign_pdo ?? 0),
            'Comp Off' => ($used['Comp Off'] ?? '0.00') . ' / ' . ($leaveLog1->assign_comp_off ?? 0),
        ];


        // === RESPONSE ===
        return response()->json([
            'status' => true,
            'leave_log' => $leaveLog,
            'work_log' => [
                'forecasted_hours' => $forecastedHours,
                'logged_hours' => round($loggedHours, 2),
                'leave_summary' => $leave_summary,
            ],
            'timesheet_overview' => $timelineItems,
            'extra_time_log' => $extra_time_log,
            'pay_off_log' => $pay_off_log,
            'comp_off_log' => $comp_off_log,
            'get_copies' => $get_copies,
            'timesheet_data' => $timesheet_data,
            'claim_data' => $claim_data,
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
        \Log::info('--- addConsultantData called ---');
        \Log::info('Date: ' . now()->toDateTimeString());
        \Log::info('Request Data:', $request->all());
        $records = json_decode($request->record, true); 
        // $records['time'] = now()->format('h:i A'); 
        // $request->merge(['record' => json_encode($records)]);
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
                    if ($request->type == "claims") {
                        $recordData = json_decode($request->record, true);
                        $recordData['time'] = $recordData['time'] ?? now()->format('h:i A');

                        $incomingApplyOn = $recordData['applyOnCell'] ?? null;
                        if ($incomingApplyOn) {
                            DB::table('consultant_dashboard')
                                ->where('user_id', $userId)
                                ->where('type', 'claims')
                                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(record, '$.applyOnCell')) = ?", [$incomingApplyOn])
                                ->delete();
                        }
                        
                        $monthYear = isset($recordData['applyOnCell']) ? implode('_', array_slice(explode(' / ', $recordData['applyOnCell']), 1)) : null;

                        DB::table('consultant_dashboard')->insert([
                            'type' => $type,
                            'record' => json_encode($recordData),
                            'user_id' => $userId,
                            'client_id' => $request->client_id,
                            'client_name' => $request->client_name,
                            'month_year' => $monthYear,
                            'status' => $status,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    } else {
                        $recordList = json_decode($request->record, true);

                        if (is_array($recordList)) {
                            foreach ($recordList as $recordData) {
                                $recordData['time'] = $recordData['time'] ?? now()->format('h:i A');

                                $incomingApplyOn = $recordData['applyOnCell'] ?? null;
                                if ($incomingApplyOn) {
                                    DB::table('consultant_dashboard')
                                        ->where('user_id', $userId)
                                        ->where('type', 'timesheet')
                                        ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(record, '$.applyOnCell')) = ?", [$incomingApplyOn])
                                        ->delete();
                                }
                                $monthYear = isset($recordData['applyOnCell']) ? implode('_', array_slice(explode(' / ', $recordData['applyOnCell']), 1)) : null;
                                DB::table('consultant_dashboard')->insert([
                                    'type' => $type,
                                    'record' => json_encode($recordData),
                                    'user_id' => $userId,
                                    'client_id' => $request->client_id,
                                    'client_name' => $request->client_name,
                                    'month_year' => $monthYear,
                                    'status' => $status,
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ]);
                            }
                        }
                    }
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

        if ($status === 'Submitted' && $type === 'claims') {
            $selectedMonth = str_pad($request->input('selectedMonth'), 2, '0', STR_PAD_LEFT);
            $selectedYear = $request->input('selectedYear');
            $targetMonthYear = $selectedMonth . '_' . $selectedYear;
            $currentDate = Carbon::createFromFormat('m_Y', $targetMonthYear)->startOfMonth();
            DB::table('consultant_dashboard')->where('type', 'claims')->where('user_id', $userId)->where('month_year', $targetMonthYear)->update(['status' => 'Submitted', 'updated_at' => now() ]);
            $loopDate = $currentDate->copy()->subMonth();
            while (true) {
                $loopMonthYear = $loopDate->format('m_Y');
                $draftsExist = DB::table('consultant_dashboard')->where('type', 'claims')->where('user_id', $userId)->where('status', 'Draft')->where('month_year', $loopMonthYear)->exists();
                if (!$draftsExist) {
                    break;
                }
                DB::table('consultant_dashboard')->where('type', 'claims')->where('user_id', $userId)->where('status', 'Draft')->where('month_year', $loopMonthYear)->update(['status' => 'Submitted', 'updated_at' => now() ]);
                $loopDate->subMonth();
            }
        }
        if ($status === 'Submitted') {
            $to = $request->reporting_manager_email;
            $cc = $request->corporate_email;
            $type = $request->input('type', 'timesheet');
            \Log::info("Preparing to send {$type} email for status = Submitted.");
            if (!empty($to)) {
                try {
                    $consultant = Consultant::where('user_id', $userId)->first();
                    if (!$consultant) {
                        \Log::error("Consultant not found for user_id: {$userId}");
                        return response()->json(['success' => false, 'message' => 'Consultant not found.'], 404);
                    }
                    $token = $this->getOrCreateConsultantToken($consultant, $type);
                    $selectedYear = $request->input('selectedYear');
                    $selectedMonth = str_pad($request->input('selectedMonth'), 2, '0', STR_PAD_LEFT);
                    $monthYear = $selectedMonth . '_' . $selectedYear;
                    $dashboards = $this->fetchSubmittedDashboards($consultant->user_id, $type, $monthYear);
                    $client = DB::table('clients')->where('id', $consultant->client_id)->first();
                    $consultancy = $client ? DB::table('users')->where('id', $client->user_id)->first() : null;
                    if ($type === 'claims') {
                        $claimsByMonth = $this->groupClaimsByMonth($dashboards);
                        $pdfView = 'emails.claims_timesheet_reporting_manager_body';
                        $parentFormId = $dashboards->first()->parent_form_id ?? null;
                        $data = compact('claimsByMonth', 'token', 'consultant', 'client', 'consultancy', 'selectedMonth', 'selectedYear', 'parentFormId') + ['isPdf' => true];
                    }
                    else {
                        $totalWorkingHours = $this->calculateWorkingHours($dashboards);
                        $pdfView = 'emails.reporting_manager';
                        $data = compact('token', 'consultant', 'client', 'consultancy', 'dashboards', 'selectedMonth', 'selectedYear', 'totalWorkingHours','type') + ['isPdf' => true];
                    }
                    $pdfPath = $this->generatePDFAndStore($pdfView, $data, $type, $consultant->id);
                    $this->createRemarkRecord($consultant->id, $monthYear, $pdfPath, $type, $givenBy ?? null);
                    $this->assignParentFormId($userId);
                    $subjectText = $type === 'claims' ? 'Consultant has submitted their claim form.' : 'Consultant has submitted their timesheet.';
                    $this->sendReportingManagerEmail($type, $subjectText, $token, $selectedYear, $selectedMonth, $to, $cc);
                    return response()->json(['success' => true, 'message' => 'Email sent successfully.']);
                }
                catch(\Exception $e) {
                    \Log::error("Mail failed for {$type}. Error: {$e->getMessage() }");
                    return response()->json(['success' => false, 'message' => 'Mail sending failed.', 'error' => $e->getMessage() ], 500);
                }
            }
        }
       
        return response()->json(['success' => true, 'message' => 'Data saved successfully!']);
    }

    public function assignParentFormId(int $userId) : void {
    // Get the latest parent_form_id from only 'claims' type
    $lastForm = DB::table('consultant_dashboard')
        ->whereNotNull('parent_form_id')
        ->where('type', 'claims')
        ->orderByRaw('CAST(SUBSTRING(parent_form_id, 2) AS UNSIGNED) DESC')
        ->first();

    $lastFormId = $lastForm ? (int)substr($lastForm->parent_form_id, 1) : 999;
    $newFormId = '#' . ($lastFormId + 1);

    // Get last form_count from user's 'claims' entries
    $lastUserForm = DB::table('consultant_dashboard')
        ->where('user_id', $userId)
        ->where('type', 'claims')
        ->whereNotNull('parent_form_id')
        ->orderByDesc('form_count')
        ->value('form_count');

    $newFormCount = $lastUserForm ? $lastUserForm + 1 : 1;

        // Pick only 'claims' entries with null parent_form_id or Draft status
        $claimIds = DB::table('consultant_dashboard')
            ->where('user_id', $userId)
            ->where('type', 'claims')
            ->where(function ($query) {
                $query->whereNull('parent_form_id')
                    ->orWhere(function ($sub) {
                        $sub->whereNotNull('parent_form_id')
                            ->where('status', 'Draft');
                    });
            })
            ->pluck('id')
            ->toArray();

        if (!empty($claimIds)) {
            DB::table('consultant_dashboard')
                ->whereIn('id', $claimIds)
                ->update([
                    'parent_form_id' => $newFormId,
                    'form_count' => $newFormCount,
                    'updated_at' => now()
                ]);
        }
    }

     private function getOrCreateConsultantToken($consultant, $type) {
        $token = $type === 'claims' ? $consultant->claim_token : $consultant->token;
        if (empty($token)) {
            $token = \Str::uuid()->toString();
            if ($type === 'claims') {
                $consultant->claim_token = $token;
            }
            else {
                $consultant->token = $token;
            }
            $consultant->save();
            \Log::info("Generated new token for {$type}: {$token}");
        }
        return $token;
    }
    private function fetchSubmittedDashboards($userId, $type, $monthYear) {
        $query = DB::table('consultant_dashboard')->where('user_id', $userId)->where('type', $type)->where('status', 'Submitted');
        if ($type !== 'claims') {
            $query->where('month_year', $monthYear);
        }
        return $query->get();
    }
    private function groupClaimsByMonth($records) {
        $claimsByMonth = [];
        foreach ($records as $record) {
            $decoded = json_decode($record->record, true);
            $entries = (is_array($decoded) && isset($decoded[0])) ? $decoded : (is_array($decoded) ? [$decoded] : []);
            foreach ($entries as $data) {
                if (!empty($data['applyOnCell'])) {
                    $dateStr = preg_replace('/\s*\/\s*/', '-', trim($data['applyOnCell']));
                    try {
                        $date = \Carbon\Carbon::createFromFormat('d-m-Y', $dateStr);
                    }
                    catch(\Exception $e) {
                        continue;
                    }
                    $monthYearKey = $date->format('m_Y');
                    $day = (int)$date->format('d');
                    $claimsByMonth[$monthYearKey][$day][] = ['type' => strtolower(trim($data['expenseType'] ?? 'other')), 'claim_no' => $data['claim_no'] ?? '', 'amount' => $data['amount'] ?? '', 'particulars' => $data['particulars'] ?? '', 'remarks' => $data['remarks'] ?? '', ];
                }
            }
        }
        return $claimsByMonth;
    }
    private function calculateWorkingHours($dashboards) {
        $total = 0;
        foreach ($dashboards as $dashboard) {
            $records = json_decode($dashboard->record, true);
            if (is_array($records)) {
                foreach ($records as $item) {
                    if (!empty($item['workingHours'])) {
                        $total += floatval($item['workingHours']);
                    }
                }
            }
        }
        return $total;
    }
    private function generatePDFAndStore($view, $data, $type, $consultantId) {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView($view, $data);
        $fileName = $type . '_' . $consultantId . '_' . time() . '.pdf';
        $folder = storage_path("app/public/consultant/{$type}s");
        if (!\File::exists($folder)) {
            \File::makeDirectory($folder, 0755, true);
            \Log::info("Created directory: {$folder}");
        }
        $filePath = $folder . '/' . $fileName;
        file_put_contents($filePath, $pdf->output());
        \Log::info("PDF saved at: {$filePath}");
        return "storage/consultant/{$type}s/{$fileName}";
    }
    private function createRemarkRecord($consultantId, $monthYear, $pdfLink, $type, $givenBy) {
        DB::table('remarks')->insert(['remark' => "Harris J system update - Successfully submitted {$type}. You can track request via status bar.", 'pdf_link' => $pdfLink, 'month_of' => $monthYear, 'consultant_id' => $consultantId, 'given_by' => $givenBy, 'given_by_type' => 'system', 'created_at' => now(), 'updated_at' => now() ]);
    }
    private function sendReportingManagerEmail($type, $subjectText, $token, $year, $month, $to, $cc) {
        \Mail::to($to)->cc(!empty($cc) ? [$cc] : [])->send(new \App\Mail\ReportingManagerMail($type, $subjectText, $token, $year, $month));
        \Log::info("Email sent for {$type} to: {$to}");
    }

    public function getTimelineRemarks(Request $request)
    {
        $user = auth()->user();
        $month = $request->input('month');
        $year = $request->input('year');

        if (!$user || !$month || !$year) {
            return response()->json([
                'status' => false,
                'message' => 'Missing required parameters.',
            ], 400);
        }

        $entries = DB::table('consultant_dashboard')
            ->where('user_id', $user->id)
            ->where('type', 'timesheet')
            ->orderByDesc('updated_at')
            ->get();

        $result = [];
        $leaveTypesWithRemarks = ['AL', 'PH', 'PDO', 'UL', 'Comp Off'];

        foreach ($entries as $entry) {
            $record = json_decode($entry->record, true);

            // Skip if not array
            if (!is_array($record)) continue;

            // Ensure we always loop on an array of entries
            $records = array_is_list($record) ? $record : [$record];


            foreach ($records as $rec) {
                $leaveType = $rec['leaveType'] ?? null;
                $workingHours = $rec['workingHours'] ?? null;
                $applyOnCell = $rec['applyOnCell'] ?? null;
                $dateRange = $rec['date'] ?? null;
                $remarks = $rec['remarks'] ?? null;
                $time = $rec['time'] ?? null;
                $status = $entry->status ?? null;

                $badge = $leaveType;
                $dates = [];

                // Handle date ranges
                if ($dateRange && str_contains($dateRange, 'to')) {
                    try {
                        [$start, $end] = array_map('trim', explode('to', $dateRange));
                        $startDate = \Carbon\Carbon::createFromFormat('d / m / Y', $start);
                        $endDate = \Carbon\Carbon::createFromFormat('d / m / Y', $end);
                        while ($startDate->lte($endDate)) {
                            $dates[] = $startDate->copy();
                            $startDate->addDay();
                        }
                    } catch (\Exception $e) {}
                } elseif ($applyOnCell) {
                    try {
                        $dates[] = \Carbon\Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                    } catch (\Exception $e) {}
                }

                foreach ($dates as $date) {
                    if ($date->dayOfWeek === 0 || $date->dayOfWeek === 6) continue;
                    if ($date->month != $month || $date->year != $year) continue;

                    $formatted = $date->format('d / m / Y') . ($time ? ' ' . $time : '');
                    $systemUpdate = "Harris J system update - Successfully submitted timesheet. You can track request via status bar.";

                    // Default remarks logic
                    $finalRemarks = null;

                    if ($workingHours) {
                        $finalRemarks = "Working - {$workingHours} hours";
                    } elseif ($leaveType === 'ML') {
                        $finalRemarks = $remarks ?: "{$user->name} has applied for medical leave";
                    } elseif (in_array($leaveType, $leaveTypesWithRemarks)) {
                        $finalRemarks = $remarks ?: null;
                    }

                    // Append system message if submitted
                    if ($status === 'Submitted') {
                        if ($finalRemarks) {
                            $finalRemarks .= ', ' . $systemUpdate;
                        } else {
                            $finalRemarks = $systemUpdate;
                        }
                    }

                    $result[] = [
                        'formatted' => $formatted,
                        'badge' => $badge,
                        'message' => null,
                        'remarks' => $finalRemarks,
                    ];
                }
            }
        }

        return response()->json([
            'status' => true,
            'data' => $result,
        ]);
    }

    public function getClaimRemarks(Request $request)
    {
        $user = auth()->user();
        $month = $request->input('month');
        $year = $request->input('year');

        if (!$user || !$month || !$year) {
            return response()->json([
                'status' => false,
                'message' => 'Missing required parameters.',
            ], 400);
        }

        $claims = DB::table('consultant_dashboard')
            ->where('user_id', $user->id)
            ->where('type', 'claims')
            ->orderByDesc('created_at')
            ->get();

        $result = [];

        foreach ($claims as $item) {
            $record = json_decode($item->record ?? '{}', true);
            if (!$record) continue;

            $applyDate = $record['applyOnCell'] ?? null;
            $claimNo = $record['claim_no'] ?? 'N/A';
            $remarks = $record['remarks'] ?? '';
            $time = $record['time'] ?? null;

            // Format date
            try {
                $dateObj = $applyDate ? \Carbon\Carbon::createFromFormat('d / m / Y', trim($applyDate)) : null;
            } catch (\Exception $e) {
                $dateObj = null;
            }

            if ($dateObj && (int)$dateObj->month == (int)$month && (int)$dateObj->year == (int)$year) {
                $statusText = ucfirst($item->status ?? 'Draft');
                $statusTime = $dateObj && $time ? $dateObj->format('d / m / Y') . ' ' . $time : $applyDate;

                $result[] = [
                    'claim_no' => $claimNo,
                    'remarks' => $remarks,
                    'status' => $statusText,
                    'status_time' => $statusTime,
                    'avatar' => $item->profile_image ?? 'https://i.pravatar.cc/24',
                    'user_name' => $item->user_name ?? 'User',
                    'apply_on' => $applyDate,
                ];
            }
        }

        return response()->json([
            'status' => true,
            'data' => $result,
        ]);
    }




    public function getBackdatedClaimsData(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);
    
        $userId = $request->input('user_id');
        $currentMonthYear = Carbon::now()->format('m_Y');
    
        $claims = DB::table('consultant_dashboard')
            ->where('user_id', $userId)
            ->where('type', 'claims')
            ->where('status', '!=', 'Draft')
            ->whereNotNull('parent_form_id')
            ->where('month_year', '!=', $currentMonthYear)
            ->orderBy('parent_form_id')
            ->get()
            ->groupBy('parent_form_id');
    
        $blocks = [];
        $currentBlock = 1;
        $formIndex = 0;
    
        foreach ($claims as $formId => $groupedClaims) {
            $blockKey = 'Blk ' . $currentBlock;
            if (!isset($blocks[$blockKey])) {
                $blocks[$blockKey] = [
                    '1' => 0, // Taxi
                    '2' => 0, // Dining
                    '3' => 0, // Others
                ];
            }
    
            foreach ($groupedClaims as $claim) {
                $record = json_decode($claim->record, true);
                $type = strtolower($record['expenseType'] ?? '');
                if ($type === 'taxi') {
                    $blocks[$blockKey]['1']++;
                } elseif ($type === 'dining') {
                    $blocks[$blockKey]['2']++;
                } else {
                    $blocks[$blockKey]['3']++;
                }
            }
    
            $formIndex++;
            if ($formIndex % 3 === 0) {
                $currentBlock++;
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => count($blocks) > 0
                ? 'Backdated claims data retrieved successfully.'
                : 'No backdated claims found.',
            'data' => $blocks,
        ]);
    }

    public function generateClaimCodeFromDate($dateStr)
    {
        // Remove all non-digits, e.g., "02 / 04 / 2025" → "02042025"
        $clean = preg_replace('/\D/', '', $dateStr);

        // Create numeric hash like JS `(hash << 5) - hash + charCode`
        $hash = 0;
        $chars = str_split($clean);

        foreach ($chars as $ch) {
            $charCode = ord($ch); // ASCII value
            $hash = ($hash << 5) - $hash + $charCode;
            // Force 32-bit signed int overflow behavior (same as JS `|= 0`)
            $hash = $hash & 0xFFFFFFFF;
        }

        // Ensure positive number (like `Math.abs` in JS)
        if ($hash < 0) {
            $hash = ~$hash + 1;
        }

        // Convert to base36 and return first 5 characters in uppercase
        $base36 = strtoupper(base_convert($hash, 10, 36));
        return 'CF' . substr($base36, 0, 5);
    }


    public function addClaim(Request $request)
    {
        $recordData = json_decode($request->record, true);

        $clean = preg_replace('/\D/', '', $recordData['applyOnCell']);
        $hash = 0;
        $chars = str_split($clean);
        foreach ($chars as $ch) {
            $charCode = ord($ch);
            $hash = (($hash << 5) - $hash + $charCode) & 0xFFFFFFFF;
        }
        if ($hash & 0x80000000) {
            $hash = -((~$hash + 1) & 0xFFFFFFFF);
        }
        $hash = abs($hash);
        $base36 = strtoupper(base_convert($hash, 10, 36));
        $claim_no = 'CF' . substr($base36, 0, 5);

        // ✅ Validate required parameters
        $required = ['record', 'type', 'user_id', 'client_id', 'client_name'];
        foreach ($required as $field) {
            if (!$request->filled($field)) {
                return response()->json([
                    'success' => false,
                    'message' => "Missing required field: {$field}"
                ], 400);
            }
        }

        if (!is_array($recordData)) {
            return response()->json(['success' => false, 'message' => 'Invalid record.']);
        }

        // ✅ Add current time
        $recordData['time'] = now()->format('h:i A');
        $recordData['claim_no'] = $claim_no;

        // ✅ Handle file upload
        if ($request->hasFile('certificate')) {
            $image = $request->file('certificate');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('consultant', $fileName);
            $recordData['certificate_path'] = 'storage/app/public/consultant/' . $fileName;
        } else {
            $recordData['certificate_path'] = $recordData['certificate_path'] ?? null;
        }

        // ✅ Insert or Update logic
        if ($request->filled('edit_id')) {
            // Update existing record
            $monthYear = isset($recordData['applyOnCell']) ? implode('_', array_slice(explode(' / ', $recordData['applyOnCell']), 1)) : null;
            DB::table('consultant_dashboard')
                ->where('id', $request->edit_id)
                ->update([
                    'type' => $request->type,
                    'record' => json_encode($recordData),
                    'user_id' => $request->user_id,
                    'month_year' => $monthYear,
                    'client_id' => $request->client_id,
                    'client_name' => $request->client_name,
                    'status' => $request->status ?? 'Draft',
                    'updated_at' => now()
                ]);

            return response()->json(['success' => true, 'message' => 'Claim updated.']);
        } else {
            $monthYear = isset($recordData['applyOnCell']) ? implode('_', array_slice(explode(' / ', $recordData['applyOnCell']), 1)) : null;
            // Insert new record
            DB::table('consultant_dashboard')->insert([
                'type' => $request->type,
                'record' => json_encode($recordData),
                'user_id' => $request->user_id,
                'client_id' => $request->client_id,
                'month_year' => $monthYear,
                'client_name' => $request->client_name,
                'status' => $request->status ?? 'Draft',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json(['success' => true, 'message' => 'New claim added.']);
        }
    }


    public function getClaimAndGetCopies(Request $request)
    {
        $user = auth()->user();
        $month = $request->input('month');
        $year = $request->input('year');

        if (!$user || !$month || !$year) {
            return response()->json([
                'status' => false,
                'message' => 'Missing required parameters.',
            ], 400);
        }

        $rawRecords = DB::table('consultant_dashboard')
            ->where('user_id', $user->id)
            ->where('type', 'claims')
            ->get();

        $groupedClaims = [];
        $getCopies = [];

        foreach ($rawRecords as $item) {
            $record = json_decode($item->record, true);
            $applyOnCell = $record['applyOnCell'] ?? null;
            $claimNo = $record['claim_no'] ?? null;

            if ($applyOnCell && $claimNo) {
                try {
                    $date = \Carbon\Carbon::createFromFormat('d / m / Y', $applyOnCell);
                    if ($date->month == $month && $date->year == $year) {
                        $groupKey = $claimNo . '_' . $applyOnCell;

                        // group for modal (claims)
                        if (!isset($groupedClaims[$groupKey])) {
                            $groupedClaims[$groupKey] = [
                                'claim_no' => $claimNo,
                                'apply_date' => $applyOnCell,
                                'status' => $item->status,
                                'entries' => []
                            ];
                        }

                        $record['id'] = $item->id;
                        $record['status'] = $item->status;
                        $groupedClaims[$groupKey]['entries'][] = $record;

                        // group for getCopies view
                        if (!isset($getCopies[$claimNo])) {
                            $getCopies[$claimNo] = [
                                'claim_no' => $claimNo,
                                'amount' => 0,
                                'items' => []
                            ];
                        }

                        $getCopies[$claimNo]['amount'] += (float) ($record['amount'] ?? 0);
                        $getCopies[$claimNo]['items'][] = $record;
                    }

                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        // Final formatting
        $claims = [];
        foreach ($groupedClaims as $group) {
            $group['count'] = count($group['entries']);
            $claims[] = $group;
        }

        $copies = array_values($getCopies); // reset keys

        return response()->json([
            'status' => true,
            'message' => 'Grouped claims fetched successfully.',
            'data' => [
                'claims' => $claims,
                'getCopies' => $copies
            ],
        ]);
    }

    public function deleteCliam($id)
    {
        // Check if the claim exists
        $claim = DB::table('consultant_dashboard')->where('id', $id)->first();

        if (!$claim) {
            return response()->json([
                'success' => false,
                'message' => 'Claim not found.'
            ], 404);
        }

        // Optionally delete uploaded certificate file if exists
        $record = json_decode($claim->record, true);
        if (!empty($record['certificate_path']) && file_exists(base_path($record['certificate_path']))) {
            @unlink(base_path($record['certificate_path']));
        }

        // Delete the claim
        DB::table('consultant_dashboard')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Claim deleted successfully.'
        ]);
    }





}
