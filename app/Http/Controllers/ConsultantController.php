<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Consultant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\TimesheetStatusMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
class ConsultantController extends Controller {
    public function index() {
        $currentUrl = url()->full();
        $userData = Session::get('user_data');
        $userId = $userData['id'] ?? null;
        $consultant = Consultant::where('login_email', $userData['email'])->first();
        if ($userData['role_id'] == 11) {
            $dataTimesheet = DB::table('consultant_dashboard')->where('user_id', $userId)->where('type', 'timesheet')->orderBy('id', 'desc')->get();
            $dataClaims = DB::table('consultant_dashboard')->where('user_id', $userId)->where('type', 'claims')->orderBy('id', 'desc')->get();
            $publicHolidays = DB::table('public_holidays')->get();
             $leaveLogData = DB::table('leave_log')
            ->where('user_id', $userId)
            ->first();
            $token = $consultant->token ?? null;
             $feedbacksgData = DB::table('feedbacks')
            ->where('sender_id', $userId)
            ->get();
            return view('consultant.dashboard', compact('consultant','feedbacksgData', 'userData', 'dataTimesheet', 'dataClaims', 'publicHolidays','leaveLogData', 'token'));
        }
        else {
            return view('errors.404');
        }
    }
    public function updateBasicDetailsConsultant(Request $request) {
        $consultant = Consultant::findOrFail($request->id);
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
        return redirect()->intended(route('consultant.dashboard'));
    }
    public function information() {
        $userData = Session::get('user_data');
        $userId = Session::get('user_data') ['id'] ?? null;
        $consultant = Consultant::where('login_email', $userData['email'])->first();
        return view('consultant.basic_info_page', compact('consultant'));
    }
    public function create() {
    }
    public function getTimesheetStatus(Request $request) {
        $userId = auth()->id();
        $month = (int)$request->query('month') + 1;
        $year = (int)$request->query('year');
        $entries = DB::table('consultant_dashboard')->where('user_id', $userId)->where('type', 'timesheet')->get();
        $filtered = $entries->filter(function ($item) use ($month, $year) {
            $record = json_decode($item->record, true);
            if (!isset($record['applyOnCell'])) return false;
            $dateStr = trim($record['applyOnCell']);
            $date = \DateTime::createFromFormat('d / m / Y', $dateStr);
            return $date && ((int)$date->format('n') === $month) && ((int)$date->format('Y') === $year);
        });
        if ($filtered->isEmpty()) {
            return response()->json(['status' => null]);
        }
        $statuses = $filtered->pluck('status')->map(fn($s) => strtolower(trim($s)));
        if ($statuses->contains('draft')) {
            return response()->json(['status' => 'draft']);
        }
        if ($statuses->every(fn($s) => $s === 'submitted')) {
            return response()->json(['status' => 'submitted']);
        }
        return response()->json(['status' => null]);
    }
    public function getTimesheetStatusReportingManager(Request $request) {
        $userId = (int)$request->query('user_id');
        $month = (int)$request->query('month') + 1;
        $year = (int)$request->query('year');
        $entries = DB::table('consultant_dashboard')->where('user_id', $userId)->where('type', 'timesheet')->get();
        $filtered = $entries->filter(function ($item) use ($month, $year) {
            $record = json_decode($item->record, true);
            if (!isset($record['applyOnCell'])) return false;
            $dateStr = trim($record['applyOnCell']);
            $date = \DateTime::createFromFormat('d / m / Y', $dateStr);
            return $date && ((int)$date->format('n') === $month) && ((int)$date->format('Y') === $year);
        });
        if ($filtered->isEmpty()) {
            return response()->json(['status' => null]);
        }
        $statuses = $filtered->pluck('status')->map(fn($s) => strtolower(trim($s)));
        if ($statuses->contains('draft')) {
            return response()->json(['status' => 'draft']);
        }
        if ($statuses->every(fn($s) => $s === 'submitted')) {
            return response()->json(['status' => 'submitted']);
        }
        return response()->json(['status' => null]);
    }
    public function getClaimStatus(Request $request) {
        $userId = auth()->id();
        $month = (int)$request->query('month') + 1;
        $year = (int)$request->query('year');
        $entries = DB::table('consultant_dashboard')->where('user_id', $userId)->where('type', 'claims')->get();
        $filtered = $entries->filter(function ($item) use ($month, $year) {
            $record = json_decode($item->record, true);
            if (!isset($record['applyOnCell'])) return false;
            $dateStr = trim($record['applyOnCell']);
            $date = \DateTime::createFromFormat('d / m / Y', $dateStr);
            return $date && ((int)$date->format('n') === $month) && ((int)$date->format('Y') === $year);
        });
        if ($filtered->isEmpty()) {
            return response()->json(['status' => null]);
        }
        $statuses = $filtered->pluck('status')->map(fn($s) => strtolower(trim($s)));
        if ($statuses->contains('draft')) {
            return response()->json(['status' => 'draft']);
        }
        if ($statuses->every(fn($s) => $s === 'submitted')) {
            return response()->json(['status' => 'submitted']);
        }
        return response()->json(['status' => null]);
    }
    /*public function addConsultantData(Request $request) {
        $recordData = json_decode($request->record, true);
        $applyOnCell = $recordData['applyOnCell'] ?? null;
        $incomingExpenseType = $recordData['expenseType'] ?? null;
        $type = $request->type;
        $status = $request->status ?? 'Draft';
        if (!empty($recordData['date']) && strpos($recordData['date'], 'to') !== false) {
            $rangeParts = explode(' to ', $recordData['date']);
            if (count($rangeParts) === 2) {
                try {
                    $start = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[0]));
                    $end = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[1]));
                    while ($start->lte($end)) {
                        $formattedDate = $start->format('d / m / Y');
                        $rowsToDelete = DB::table('consultant_dashboard')->where('type', 'timesheet')->where('user_id', $request->user_id)->whereJsonContains('record->applyOnCell', $formattedDate)->get();
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
                }
                catch(\Exception $e) {
                    \Log::error("Failed to delete overlapping workingHours: " . $e->getMessage());
                }
            }
        }
        $match = null;
        $existingRecords = DB::table('consultant_dashboard')->where('type', $type)->where('user_id', $request->user_id)->get();
        foreach ($existingRecords as $row) {
            $decoded = json_decode($row->record, true);
            if (($type === 'timesheet' && !empty($decoded['applyOnCell']) && $decoded['applyOnCell'] === $applyOnCell) || ($type === 'claims' && !empty($decoded['expenseType']) && $decoded['expenseType'] === $incomingExpenseType && !empty($decoded['applyOnCell']) && $decoded['applyOnCell'] === $applyOnCell)) {
                $match = $row;
                break;
            }
        }
        $oldImagePath = $match ? (json_decode($match->record, true) ['certificate_path'] ?? null) : null;
        if ($request->hasFile('certificate')) {
            if ($oldImagePath && file_exists(base_path($oldImagePath))) {
                unlink(base_path($oldImagePath));
            }
            $image = $request->file('certificate');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('consultant', $fileName);
            $recordData['certificate_path'] = 'storage/app/public/consultant/' . $fileName;
        }
        elseif (!$request->hasFile('certificate') && !$match) {
            $recordData['certificate_path'] = null;
        }
        elseif (!$request->hasFile('certificate') && $match) {
            $recordData['certificate_path'] = $oldImagePath;
        }
        if ($match) {
            $finalStatus = $status;
            $existing = DB::table('consultant_dashboard')->where('id', $match->id)->first();
            if ($existing) {
                $existingRecord = json_decode($existing->record, true) ?? [];
                if (isset($existingRecord['claim_no'])) {
                    $recordData['claim_no'] = $existingRecord['claim_no'];
                }
                DB::table('consultant_dashboard')->where('id', $match->id)->update(['record' => json_encode($recordData), 'client_id' => $request->client_id, 'client_name' => $request->client_name, 'status' => $finalStatus, 'updated_at' => now() ]);
            }
            if ($finalStatus === 'Submitted') {
                try {
                    $applyDate = \Carbon\Carbon::createFromFormat('d / m / Y', $applyOnCell);
                    $month = $applyDate->format('m');
                    $year = $applyDate->format('Y');
                    $allSameMonth = DB::table('consultant_dashboard')->where('type', $type)->where('user_id', $request->user_id)->get();
                    foreach ($allSameMonth as $row) {
                        $decoded = json_decode($row->record, true);
                        $cellDate = $decoded['applyOnCell'] ?? null;
                        if ($cellDate) {
                            try {
                                $cellDateCarbon = \Carbon\Carbon::createFromFormat('d / m / Y', trim($cellDate));
                                if ($cellDateCarbon->isSameMonth($applyDate)) {
                                    DB::table('consultant_dashboard')->where('id', $row->id)->update(['status' => 'Submitted', 'updated_at' => now() ]);
                                }
                            }
                            catch(\Exception $e) {
                                \Log::warning("Invalid applyOnCell format in row ID {$row->id}");
                            }
                        }
                    }
                }
                catch(\Exception $e) {
                    \Log::error("Failed to update same month records to Submitted: " . $e->getMessage());
                }
            }
        }
        else {
            try {
                $applyDate = \Carbon\Carbon::createFromFormat('d / m / Y', $applyOnCell);
                $month = $applyDate->format('m');
                $year = $applyDate->format('Y');
                $sameMonthRecords = DB::table('consultant_dashboard')->where('type', $type)->where('user_id', $request->user_id)->get();
                foreach ($sameMonthRecords as $row) {
                    $decoded = json_decode($row->record, true);
                    $cellDate = $decoded['applyOnCell'] ?? null;
                    if ($cellDate) {
                        try {
                            $cellDateCarbon = \Carbon\Carbon::createFromFormat('d / m / Y', trim($cellDate));
                            if ($cellDateCarbon->format('m') === $month && $cellDateCarbon->format('Y') === $year) {
                                DB::table('consultant_dashboard')->where('id', $row->id)->update(['status' => $status, 'updated_at' => now() ]);
                            }
                        }
                        catch(\Exception $e) {
                            \Log::warning("Invalid applyOnCell format in row ID {$row->id}");
                        }
                    }
                }
            }
            catch(\Exception $e) {
                \Log::error("Month status sync before insert failed: " . $e->getMessage());
            }
            DB::table('consultant_dashboard')->insert(['type' => $type, 'record' => json_encode($recordData), 'user_id' => $request->user_id, 'client_id' => $request->client_id, 'client_name' => $request->client_name, 'status' => $status, 'created_at' => now(), 'updated_at' => now() ]);
        }
        if ($status === 'Submitted') {
            $to = $request->reporting_manager_email;
            $cc = $request->corporate_email;
            if (!empty($to)) {
                try {
                    $consultant = \App\Models\Consultant::where('user_id', $request->user_id)->first();
                    $token = $consultant->token ?? null;
                    Mail::to($to)
                        ->cc(!empty($cc) ? [$cc] : [])
                        ->send(new \App\Mail\ReportingManagerMail('Timesheet Submitted', 'Consultant has submitted their record.', $token));
                } catch (\Exception $e) {
                    \Log::error("Mail sending failed to Reporting Manager: " . $e->getMessage());
                }
            }
        }
        return response()->json(['success' => true, 'message' => 'Data saved successfully!']);
    }*/
    public function addConsultantData(Request $request) {
    $records = json_decode($request->record, true); 
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
                'pdf_link' => 'storage/consultant/timesheets/timesheet_1_1747744125.pdf',
                'month_of' => '5-2025',
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
    public function deleteClaim(Request $request) {
        $id = $request->id;
        $record = DB::table('consultant_dashboard')->where('id', $id)->first();
        if ($record) {
            $decoded = json_decode($record->record, true);
            $imagePath = $decoded['certificate_path'] ?? null;
            if ($imagePath) {
                $fullPath = base_path($imagePath);
                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                }
            }
            $deleted = DB::table('consultant_dashboard')->where('id', $id)->delete();
            return response()->json(['success' => $deleted > 0, 'message' => 'Claim deleted successfully (image removed if existed).']);
        }
        return response()->json(['success' => false, 'message' => 'Claim not found.']);
    }
    public function updateTimesheetStatus(Request $request, $id) {
        $month = (int)$request->query('month');
        $year = (int)$request->query('year');
        $user_id = $id;
        $user_data = DB::table('users')->where('id', $id)->where('status', 'Active')->first(['email']);
        if (!$user_data || empty($user_data->email)) {
            abort(404);
        }
        $publicHolidays = DB::table('public_holidays')->get();
        $consultant = Consultant::where('login_email', $user_data->email)->first();
        $allRows = DB::table('consultant_dashboard')->where('user_id', $id)->where('type', 'timesheet')->where('status', 'Submitted')->orderBy('id', 'desc')->get();
        $dataTimesheet = $allRows->filter(function ($row) use ($month, $year) {
            $record = json_decode($row->record ?? '{}', true);
            $applyOnCell = $record['applyOnCell'] ?? null;
            if ($applyOnCell) {
                try {
                    $date = \Carbon\Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                    return $date->month == $month && $date->year == $year;
                }
                catch(\Exception $e) {
                    return false;
                }
            }
            return false;
        })->values();
        if ($dataTimesheet->isEmpty() || !$consultant || $publicHolidays->isEmpty()) {
            abort(404);
        }
        return view('consultant.Reporting_manager_approval_page', compact('dataTimesheet', 'consultant', 'publicHolidays', 'user_id'));
    }
    public function store(Request $request) {
    }
    public function show(string $id) {
    }
    public function edit(string $id) {
    }
    public function update(Request $request, string $id) {
    }
    public function destroy(string $id) {
    }
    public function approveConsultantSheet() {
        $token = request()->segment(count(request()->segments()));
        $consultant = DB::table('consultants')->where('token', $token)->first();
        if (!$consultant) {
            $errorMessage = "Invalid or expired token. The timesheet you're trying to access is not available.";
            return view('emails.token-error', compact('errorMessage'));
        }
        $client = null;
        $consultancy = null;
        $dashboards = collect();
        $totalWorkingHours = 0;
        $selectedMonth = date('m');
        $selectedYear = date('Y');
        $type = 'Timesheet Submitted';
        $dashboards = DB::table('consultant_dashboard')
            ->where('user_id', $consultant->user_id)
            ->where('type', 'timesheet')
            ->where('status', 'Submitted')
            ->get();
        foreach ($dashboards as $dashboard) {
            $records = json_decode($dashboard->record, true);
            if (is_array($records)) {
                foreach ($records as $item) {
                    if (!empty($item['workingHours'])) {
                        $totalWorkingHours += floatval($item['workingHours']);
                    }
                }
            }
        }
        $client = DB::table('clients')->where('id', $consultant->client_id)->first();
        if ($client && !empty($client->user_id)) {
            $consultancy = DB::table('users')->where('id', $client->user_id)->first();
        }
        return view('emails.view-timesheet', compact(
            'type',
            'token',
            'consultant',
            'client',
            'consultancy',
            'dashboards',
            'selectedYear',
            'selectedMonth',
            'totalWorkingHours'
        ));
    }


public function updateTimesheetStatusMail(Request $request)
{
    $request->validate([
        'ids' => 'required|array',
        'status' => 'required|string|in:Approved,Rejected,Draft',
        'token' => 'required|string',
        'month' => 'required|string',
        'year' => 'required|string',
    ]);

    $status = $request->status;
    $ids = $request->ids;
    $month = $request->month;
    $year = $request->year;

    // Message to be sent in email
    $emailMessage = match ($status) {
        'Approved' => 'Your timesheet has been Approved.',
        'Rejected' => 'Your timesheet has been Rejected.',
        'Draft'    => 'Your timesheet has been sent for Rework.',
    };

    // Message to be saved in remarks table
    $remarksMessage = 'Harris J system update - ' . $emailMessage;

    $consultant = DB::table('consultants')->where('token', $request->token)->first();
    $client = null;
    $consultancy = null;

    if ($consultant) {
        $client = DB::table('clients')->where('id', $consultant->client_id)->first();
        if ($client && !empty($client->user_id)) {
            $consultancy = DB::table('users')->where('id', $client->user_id)->first();
        }
    }

    $dashboards = DB::table('consultant_dashboard')->whereIn('id', $ids)->get();

    $totalWorkingHours = 0;
    foreach ($dashboards as $dashboard) {
        $record = json_decode($dashboard->record, true);
        if (!empty($record['workingHours']) && is_numeric($record['workingHours'])) {
            $totalWorkingHours += floatval($record['workingHours']);
        }
    }

    $viewData = [
        'type' => 'Timesheet Submission',
        'token' => $request->token,
        'consultant' => $consultant,
        'client' => $client,
        'consultancy' => $consultancy,
        'dashboards' => $dashboards,
        'selectedYear' => $year,
        'selectedMonth' => $month,
        'totalWorkingHours' => $totalWorkingHours,
        'isPdf' => true
    ];

    $pdf = Pdf::loadView('emails.reporting_manager', $viewData);

    $fileName = 'timesheet_' . $consultant->id . '_' . time() . '.pdf';
    $folder = storage_path('app/public/consultant/timesheets');
    if (!File::exists($folder)) {
        File::makeDirectory($folder, 0755, true);
    }

    $filePath = $folder . '/' . $fileName;
    $storagePath = 'storage/consultant/timesheets/' . $fileName;
    file_put_contents($filePath, $pdf->output());

    foreach ($ids as $id) {
        DB::table('consultant_dashboard')->where('id', $id)->update([
            'status' => $status,
            'updated_at' => now()
        ]);

        

    }

    if ($consultant && $consultant->email) {
        Mail::to($consultant->email)->send(new TimesheetStatusMail($status, $consultant->emp_name));

        DB::table('consultants')->where('id', $consultant->id)->update([
            'token' => Str::uuid()->toString(),
            'updated_at' => now()
        ]);
        DB::table('remarks')->insert([
    'remark' => $remarksMessage,
    'pdf_link' => $storagePath,
    'month_of' => $month . '-' . $year,
    'consultant_id' => $consultant->id,
    'given_by' => 1,
    'given_by_type' => 'system',
    'created_at' => now(),
    'updated_at' => now(),
]);
    }

    return response()->json([
        'status' => true,
        'message' => 'Timesheet status updated to ' . $status
    ]);
}


}