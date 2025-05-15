<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultancy;
use App\Models\User;
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

    //PRIYAVRAT API



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




}