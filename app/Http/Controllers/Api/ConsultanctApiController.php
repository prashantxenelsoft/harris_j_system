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
class ConsultanctApiController extends Controller {
    public function apiUpdateBasicDetailsConsultant(Request $request) {
        $userData = User::findOrFail($request->user_id);
        $consultant = Consultant::where('login_email', $userData->email)->first();
        if (!$consultant) {
            return response()->json([
                'status' => false,
                'message' => 'Consultant not found for this user.',
            ], 404);
        }
        $consultant->fill($request->only([
            'first_name', 'middle_name', 'last_name', 'dob',
            'citizen', 'nationality', 'address_by_user', 'mobile_number'
        ]));
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
            'data' => $consultant
        ]);
    }
    public function getDashboardTimelineData(Request $request) {
        $user = $request->user();
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
                        'status' => $item->status
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
                $fullDate = $carbon->copy()->day($i)->format('d / m / Y');
                $fullCarbonDate = \Carbon\Carbon::createFromFormat('d / m / Y', $fullDate);
                if ($fullCarbonDate->isFuture()) continue;
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
                        'status' => $days[$i]['status']
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
                            'certificate_path' => null
                        ],
                        'status' => 'AutoFilled'
                    ];
                }
            }
            if (!empty($daysList)) {
                $finalData[] = [
                    'month' => $carbon->format('F Y'),
                    'start_date' => $carbon->startOfMonth()->toDateString(),
                    'end_date' => $carbon->endOfMonth()->toDateString(),
                    'days' => $daysList
                ];
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Timeline data compiled successfully.',
            'data' => $finalData
        ]);
    }




public function getConsultantAllDetails(Request $request)
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

    $data = DB::table('consultant_dashboard')
        ->where('user_id', $user->id)
        ->where('type', 'timesheet')
        ->get();

    // === LEAVE LOG ===
    $leaveLog = $data->filter(function ($item) use ($month, $year) {
        $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;
        if (!isset($record['applyOnCell']) || !isset($record['leaveType'])) return false;

        $parts = explode(' / ', $record['applyOnCell']);
        return count($parts) === 3 && $parts[1] == str_pad($month, 2, '0', STR_PAD_LEFT) && $parts[2] == $year;
    })->map(function ($item) {
        $item->record = is_string($item->record) ? json_decode($item->record, true) : $item->record;
        return $item;
    })->values();

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

        if (!isset($record['applyOnCell']) || !isset($record['workingHours'])) return $carry;

        $parts = explode(' / ', $record['applyOnCell']);
        if (count($parts) !== 3) return $carry;

        if ($parts[1] == str_pad($month, 2, '0', STR_PAD_LEFT) && $parts[2] == $year) {
            return $carry + (is_numeric($record['workingHours']) ? (float)$record['workingHours'] : 0);
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

        if (!$leaveType && !$subType) continue;

        $leaveShort = '';
        if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
        elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
        elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';

        $topLabel = strtoupper($leaveType ?? ucfirst(str_replace('_', ' ', $subType)));
        $mainLabel = $labelMap[$leaveType] ?? $labelMap[$subType] ?? null;
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
            } catch (\Exception $e) {}
        } elseif ($applyOnCell) {
            try {
                $dates[] = \Carbon\Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
            } catch (\Exception $e) {}
        }

        foreach ($dates as $date) {
            if (in_array($date->dayOfWeek, [0, 6])) continue; // Skip weekends
            if ($date->month != $month || $date->year != $year) continue; // Filter by current month/year

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

    $extra_time_log = $data->filter(function ($item) use ($month, $year) {
        $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

        if (!isset($record['type'], $record['applyOnCell'])) return false;

        $parts = explode(' / ', $record['applyOnCell']);
        if (count($parts) !== 3) return false;

        return $parts[1] == str_pad($month, 2, '0', STR_PAD_LEFT)
            && $parts[2] == $year
            && in_array($record['type'], ['comp_off', 'pay_off', 'ignore']);
    })->map(function ($item) {
        $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

        $labelMap = [
            'comp_off' => ['label' => 'Comp - Off', 'color' => '#d35400'],
            'pay_off'  => ['label' => 'Pay - Off',  'color' => '#2980b9'],
            'ignore'   => ['label' => 'Ignored',    'color' => '#7f8c8d'],
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
    })->values();

    $pay_off_log = $data->filter(function ($item) use ($month, $year) {
    $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

    if (!isset($record['type'], $record['applyOnCell']) || $record['type'] !== 'pay_off') return false;

    $parts = explode(' / ', $record['applyOnCell']);
    return count($parts) === 3 && $parts[1] == str_pad($month, 2, '0', STR_PAD_LEFT) && $parts[2] == $year;
    })->map(function ($item) {
        $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

        return [
            'date' => $record['applyOnCell'] ?? '--/--/----',
            'hours' => str_pad($record['extraHours'] ?? '0', 2, '0', STR_PAD_LEFT) . ' : 00',
        ];
    })->values();

    $comp_off_log = [];

    foreach ($data as $item) {
        $record = is_string($item->record) ? json_decode($item->record, true) : $item->record;

        if (($record['leaveType'] ?? '') !== 'Custom COMP-OFF') continue;

        $leaveHour = $record['leaveHour'] ?? '';
        $extraHours = isset($record['extraHours']) ? (int)$record['extraHours'] : 0;
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
            } catch (\Exception $e) {}
        } elseif ($applyOnCell) {
            try {
                $dates[] = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
            } catch (\Exception $e) {}
        }

        foreach ($dates as $date) {
            if (in_array($date->dayOfWeek, [0, 6])) continue; // skip weekends
            if ($date->month != $month || $date->year != $year) continue;

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
        if (!isset($record['applyOnCell'])) continue;

        $parts = explode(' / ', $record['applyOnCell']);
        if (count($parts) !== 3) continue;

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




}