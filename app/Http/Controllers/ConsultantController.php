<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Consultant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\TimesheetStatusMail;
use Illuminate\Support\Str;
use Carbon\Carbon;
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
            $remarks_data = DB::table('remarks')->where('consultant_id', $consultant->id)->orderBy('id', 'desc')->get();
            $publicHolidays = DB::table('public_holidays')->get();
            $leaveLogData = DB::table('leave_log')
            ->where('user_id', $userId)
            ->first();
            $token = $consultant->token ?? null;
             $feedbacksgData = DB::table('feedbacks')
            ->where('sender_id', $userId)
            ->get();
          $remarksData = DB::table('consultants as c')
            ->join('remarks as r', 'c.id', '=', 'r.consultant_id')
            ->where('c.user_id', $userId)
            ->select('r.*')
            ->orderBy('r.id', 'desc')
            ->get();

            //echo "<pre>";print_r($userData);die;
            return view('consultant.dashboard', compact('consultant','remarks_data','remarksData','feedbacksgData', 'userData', 'dataTimesheet', 'dataClaims', 'publicHolidays','leaveLogData', 'token'));
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
        if ($statuses->contains('rejected')) {
            return response()->json(['status' => 'rejected']);
        }
        if ($statuses->contains('approved')) {
            return response()->json(['status' => 'approved']);
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
         if ($statuses->contains('rejected')) {
            return response()->json(['status' => 'rejected']);
        }
        if ($statuses->contains('approved')) {
            return response()->json(['status' => 'approved']);
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

    public function addNewClaim(Request $request) {
        $recordData = json_decode($request->record, true);
        $recordData['time'] = now()->format('h:i A'); 
        $request->merge(['record' => json_encode($recordData)]);
        if (!is_array($recordData)) {
            return response()->json(['success' => false, 'message' => 'Invalid record.']);
        }

        if ($request->hasFile('certificate')) {
            $image = $request->file('certificate');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('consultant', $fileName);
            $recordData['certificate_path'] = 'storage/app/public/consultant/' . $fileName;
        } else {
            $recordData['certificate_path'] = null;
        }
        $monthYear = isset($recordData['applyOnCell']) ? implode('_', array_slice(explode(' / ', $recordData['applyOnCell']), 1)) : null;

        DB::table('consultant_dashboard')->insert([
            'type' => $request->type,
            'record' => json_encode($recordData),
            'user_id' => $request->user_id,
            'client_id' => $request->client_id,
            'client_name' => $request->client_name,
            'month_year' => $monthYear,
            'status' => $request->status ?? 'Draft',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['success' => true, 'message' => 'New claim added.']);
    }

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
         if ($status === 'Submitted' && $type === 'claims') {
            $existingSubmitted = DB::table('consultant_dashboard')->where('user_id', $userId)->where('type', 'claims')->where('status', 'Submitted')->exists();
            if ($existingSubmitted) {
                return response()->json(['success' => false, 'message' => 'You have already submitted previous month\'s claims. Please wait until they are approved, rejected, or sent for rework before submitting new claims.'], 403);
            }
            $recentClaims = DB::table('consultant_dashboard')->where('user_id', $userId)->where('type', 'claims')->where('status', 'Submitted')->orderByDesc('form_count')->limit(21)->pluck('form_count')->toArray();
            if (count($recentClaims) >= 21) {
                return response()->json(['success' => false, 'message' => 'You cannot submit more than 21 latest claim forms.'], 403);
            }
        }
        foreach ($records as $recordData) {
            $applyOnCell = $recordData['applyOnCell'] ?? null;
            $recordData['time'] = now()->format('h:i A');
            $incomingExpenseType = $recordData['expenseType'] ?? null;
            if (!empty($recordData['date']) && strpos($recordData['date'], 'to') !== false) {
                $rangeParts = explode(' to ', $recordData['date']);
                if (count($rangeParts) === 2) {
                    try {
                        $start = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[0]));
                        $end = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[1]));
                        while ($start->lte($end)) {
                            $formattedDate = $start->format('d / m / Y');
                            $rowsToDelete = DB::table('consultant_dashboard')->where('type', 'timesheet')->where('user_id', $userId)->whereJsonContains('record->applyOnCell', $formattedDate)->get();
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
            $existingRecords = DB::table('consultant_dashboard')->where('type', $type)->where('user_id', $userId)->get();
            $match = null;
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
            $monthYear = str_pad($request->selectedMonth, 2, '0', STR_PAD_LEFT) . '_' . $request->selectedYear;
            if ($match) {
                $finalStatus = $status;
                $existing = DB::table('consultant_dashboard')->where('id', $match->id)->first();
                if ($existing) {
                    $existingRecord = json_decode($existing->record, true) ?? [];
                    if (isset($existingRecord['claim_no'])) {
                        $recordData['claim_no'] = $existingRecord['claim_no'];
                    }
                    $monthYear = isset($recordData['applyOnCell']) ? implode('_', array_slice(explode(' / ', $recordData['applyOnCell']), 1)) : null;

                    DB::table('consultant_dashboard')->where('id', $match->id)->update(['record' => json_encode($recordData), 'client_id' => $request->client_id, 'client_name' => $request->client_name, 'status' => $finalStatus,'month_year' => $monthYear, 'updated_at' => now() ]);
                }
            }
            else {
                $monthYear = isset($recordData['applyOnCell']) ? implode('_', array_slice(explode(' / ', $recordData['applyOnCell']), 1)) : null;

                DB::table('consultant_dashboard')->insert(['type' => $type, 'record' => json_encode($recordData), 'user_id' => $userId, 'client_id' => $request->client_id, 'client_name' => $request->client_name, 'status' => $status,'month_year' => $monthYear, 'created_at' => now(), 'updated_at' => now() ]);
            }
            try {
                $applyDate = \Carbon\Carbon::createFromFormat('d / m / Y', $applyOnCell);
                $month = $applyDate->format('m');
                $year = $applyDate->format('Y');
                $sameMonthRecords = DB::table('consultant_dashboard')->where('type', $type)->where('user_id', $userId)->get();
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
                \Log::error("Month status sync failed: " . $e->getMessage());
            }
        }
          if ($type === 'timesheet') {
        $monthYearVar = str_pad($request->selectedMonth, 2, '0', STR_PAD_LEFT) . '_' . $request->selectedYear;
        $entries = DB::table('consultant_dashboard')
            ->where('type', 'timesheet')
            ->where(function ($query) use ($monthYearVar) {
                $query->whereIn('month_year', ['00_', ''])
                    ->orWhereNull('month_year')
                    ->orWhere('month_year', $monthYearVar);
            })
            ->get();

        foreach ($entries as $entry) {
            $record = json_decode($entry->record, true);

            $dateStr = '';
            if (!empty($record['date']) && preg_match('/\d{1,2} \\/ \d{1,2} \\/ \d{4}/', $record['date'])) {
                $dateStr = $record['date'];
            } elseif (!empty($record['applyOnCell']) && preg_match('/\d{1,2} \\/ \d{1,2} \\/ \d{4}/', $record['applyOnCell'])) {
                $dateStr = $record['applyOnCell'];
            }

            if (!empty($dateStr)) {
                $dateStr = str_replace(' ', '', $dateStr);
                $dateParts = explode('/', $dateStr);

                if (count($dateParts) === 3) {
                    $month = str_pad($dateParts[1], 2, '0', STR_PAD_LEFT);
                    $year = $dateParts[2];
                    $monthYearNew = "{$month}_{$year}";

                    DB::table('consultant_dashboard')
                        ->where('id', $entry->id)
                        ->update([
                            'month_year' => $monthYearNew,
                            'status' => $entry->status === 'Submitted' ? 'Submitted' : DB::raw('status'),
                            'updated_at' => now()
                        ]);
                }
            }
        }
    if ($status === 'Submitted'){
        DB::table('consultant_dashboard')
            ->where('type', 'timesheet')
            ->where('month_year', $monthYearVar)
            ->update([
                'status' => 'Submitted',
                'updated_at' => now()
            ]);
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
    public function approveConsultantSheet()
    {
        $token = request()->segment(count(request()->segments()));
        $consultant = DB::table('consultants')->where('token', $token)->first();

        if (!$consultant) {
            $errorMessage = "Invalid or expired token. The timesheet you're trying to access is not available.";
            return view('emails.token-error', compact('errorMessage'));
        }

        $client = null;
        $consultancy = null;
        $dashboards = DB::table('consultant_dashboard')
            ->where('user_id', $consultant->user_id)
            ->where('type', 'timesheet')
            ->where('status', 'Submitted')
            ->get();

        // Default fallback month/year
        $selectedMonth = date('m');
        $selectedYear = date('Y');

        if ($dashboards->isNotEmpty()) {
            $first = $dashboards->first();
            if (!empty($first->month_year) && str_contains($first->month_year, '_')) {
                [$selectedMonth, $selectedYear] = explode('_', $first->month_year);
            }
        }

        $totalWorkingHours = 0;
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
    $type = 'Timesheet Submitted';
        return view('emails.view-timesheet', compact(
            'type', 'token', 'consultant', 'client',
            'consultancy', 'dashboards', 'selectedYear',
            'selectedMonth', 'totalWorkingHours'
        ));
    }


    public function updateTimesheetStatusMail(Request $request) {
        $request->validate(['ids' => 'required|array', 'status' => 'required|string|in:Approved,Rejected,Draft', 'token' => 'required|string', 'month' => 'required|string', 'year' => 'required|string', ]);
        $status = $request->status;
        $ids = $request->ids;
        $month = $request->month;
        $year = $request->year;
        $emailMessage = match($status) {
            'Approved' => 'Your timesheet has been Approved.', 'Rejected' => 'Your timesheet has been Rejected.', 'Draft' => 'Your timesheet has been sent for Rework.',
        };
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
        $viewData = ['type' => 'Timesheet Submission', 'token' => $request->token, 'consultant' => $consultant, 'client' => $client, 'consultancy' => $consultancy, 'dashboards' => $dashboards, 'selectedYear' => $year, 'selectedMonth' => $month, 'totalWorkingHours' => $totalWorkingHours, 'isPdf' => true];
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
            DB::table('consultant_dashboard')->where('id', $id)->update(['status' => $status, 'updated_at' => now() ]);
        }
        if ($consultant && $consultant->email) {
            Mail::to($consultant->email)->send(new TimesheetStatusMail($status, $consultant->emp_name));
            DB::table('consultants')->where('id', $consultant->id)->update(['token' => Str::uuid()->toString(), 'updated_at' => now() ]);
            DB::table('remarks')->insert(['remark' => $remarksMessage, 'pdf_link' => $storagePath, 'month_of' => $month . '_' . $year, 'consultant_id' => $consultant->id, 'given_by' => 1, 'given_by_type' => 'system', 'created_at' => now(), 'updated_at' => now(), ]);
        }
        return response()->json(['success' => true, 'message' => 'Timesheet status updated to ' . $status]);
    }

    public function approveConsultantSheetClaim()
    {
        $token = request()->segment(count(request()->segments()));
        
        $consultant = DB::table('consultants')->where('claim_token', $token)->first();
        if (!$consultant) {
            $errorMessage = "Invalid or expired token. The claim timesheet you're trying to access is not available.";
            return view('emails.token-error', compact('errorMessage'));
        }

        $client = DB::table('clients')->where('id', $consultant->client_id)->first();
        $consultancy = $client && !empty($client->user_id)
            ? DB::table('users')->where('id', $client->user_id)->first()
            : null;

        $selectedMonth = date('m');
        $selectedYear = date('Y');
        $type = 'Claim Timesheet';
        $token = $consultant->claim_token;

        $dashboards = DB::table('consultant_dashboard')
            ->where('user_id', $consultant->user_id)
            ->where('type', 'claims')
            ->where('status', 'Submitted')
            ->orderBy('month_year')
            ->get();

        $parentFormId = $dashboards->first()->parent_form_id ?? null;

        $claimsByMonth = [];
        foreach ($dashboards as $record) {
            $decoded = json_decode($record->record, true);
            $entries = (is_array($decoded) && isset($decoded[0])) ? $decoded : (is_array($decoded) ? [$decoded] : []);

            foreach ($entries as $data) {
                if (!empty($data['applyOnCell'])) {
                    $dateStr = preg_replace('/\s*\/\s*/', '-', trim($data['applyOnCell']));
                    try {
                        $date = \Carbon\Carbon::createFromFormat('d-m-Y', $dateStr);
                    } catch (\Exception $e) {
                        continue;
                    }

                    $monthYear = $date->format('m_Y');
                    $day = (int)$date->format('d');

                    $claimsByMonth[$monthYear][$day][] = [
                        'type' => strtolower(trim($data['expenseType'] ?? 'other')),
                        'claim_no' => $data['claim_no'] ?? '',
                        'amount' => $data['amount'] ?? '',
                        'particulars' => $data['particulars'] ?? '',
                        'remarks' => $data['remarks'] ?? '',
                    ];
                }
            }
        }

        // Extract first and last month from claimsByMonth
        $monthKeys = array_keys($claimsByMonth);
        sort($monthKeys);
        $firstMonth = !empty($monthKeys) ? \Carbon\Carbon::createFromFormat('m_Y', $monthKeys[0])->format('F Y') : null;
        $lastMonth = !empty($monthKeys) ? \Carbon\Carbon::createFromFormat('m_Y', end($monthKeys))->format('F Y') : null;

        return view('emails.view-timesheet-claim', compact(
            'type',
            'token',
            'consultant',
            'client',
            'consultancy',
            'selectedMonth',
            'selectedYear',
            'claimsByMonth',
            'parentFormId',
            'firstMonth',
            'lastMonth'
        ));
    }

    public function updateTimesheetStatusMailClaim(Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:Approved,Rejected,Draft',
            'token' => 'required|string',
            'month_year' => 'required|array',
            'month_year.*' => 'regex:/^\d{2}_\d{4}$/',
        ]);

        $status = $request->status;
        $token = $request->token;
        $monthYearArray = $request->month_year;

        $consultant = DB::table('consultants')->where('claim_token', $token)->first();
        if (!$consultant) {
            return response()->json(['status' => false, 'message' => 'Invalid token.'], 404);
        }

        $client = DB::table('clients')->where('id', $consultant->client_id)->first();
        $consultancy = $client && $client->user_id ? DB::table('users')->where('id', $client->user_id)->first() : null;

        $allClaimsByMonth = [];
        $allIds = [];

        foreach ($monthYearArray as $monthYearKey) {
            [$month, $year] = explode('_', $monthYearKey);

            $dashboards = DB::table('consultant_dashboard')
                ->where('user_id', $consultant->user_id)
                ->where('type', 'claims')
                ->where('month_year', $monthYearKey)
                ->get();

            foreach ($dashboards as $record) {
                $decoded = json_decode($record->record, true);
                $entries = (is_array($decoded) && isset($decoded[0])) ? $decoded : (is_array($decoded) ? [$decoded] : []);

                foreach ($entries as $data) {
                    if (!empty($data['applyOnCell'])) {
                        $dateStr = preg_replace('/\s*\/\s*/', '-', trim($data['applyOnCell']));
                        try {
                            $date = \Carbon\Carbon::createFromFormat('d-m-Y', $dateStr);
                        } catch (\Exception $e) {
                            continue;
                        }

                        $monthYear = $date->format('m_Y');
                        $day = (int)$date->format('d');

                        $allClaimsByMonth[$monthYear][$day][] = [
                            'type' => strtolower(trim($data['expenseType'] ?? 'other')),
                            'claim_no' => $data['claim_no'] ?? '',
                            'amount' => $data['amount'] ?? '',
                            'particulars' => $data['particulars'] ?? '',
                            'remarks' => $data['remarks'] ?? '',
                        ];
                    }
                }

                $allIds[] = $record->id;
            }
        }

        $remarksMessage = 'Harris J system update - ' . match ($status) {
            'Approved' => 'Your claim has been Approved.',
            'Rejected' => 'Your claim has been Rejected.',
            'Draft' => 'Your claim has been sent for Rework.',
        };

        $viewData = [
            'claimsByMonth' => $allClaimsByMonth,
            'token' => $token,
            'consultant' => $consultant,
            'client' => $client,
            'consultancy' => $consultancy,
            'selectedMonth' => '', // Optional: You may format a range string if needed
            'selectedYear' => '',
            'isPdf' => true
        ];

        $pdf = \PDF::loadView('emails.claims_timesheet_reporting_manager_body', $viewData);
        $fileName = 'claims_' . $consultant->id . '_' . time() . '.pdf';
        $folder = storage_path('app/public/consultant/claims');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }
        $filePath = $folder . '/' . $fileName;
        $storagePath = 'storage/consultant/claims/' . $fileName;
        file_put_contents($filePath, $pdf->output());

        DB::table('consultant_dashboard')
            ->whereIn('id', $allIds)
            ->update(['status' => $status, 'updated_at' => now()]);

        if ($consultant->email) {
            Mail::to($consultant->email)->send(new \App\Mail\ClaimStatusMail($status, $consultant->emp_name));

            DB::table('consultants')->where('id', $consultant->id)->update([
                'claim_token' => Str::uuid()->toString(),
                'updated_at' => now()
            ]);

            foreach ($monthYearArray as $monthYearKey) {
                DB::table('remarks')->insert([
                    'remark' => $remarksMessage,
                    'pdf_link' => $storagePath,
                    'month_of' => $monthYearKey,
                    'consultant_id' => $consultant->id,
                    'given_by' => 1,
                    'given_by_type' => 'system',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return response()->json(['status' => true, 'message' => 'Claim status updated to ' . $status]);
    }

    public function showReportingManagerView() {
        $userId = 15;
        $selectedMonth = 5;
        $selectedYear = 2025;
        $consultant = \App\Models\Consultant::where('user_id', $userId)->first();
        if (!$consultant) {
            abort(404, 'Consultant not found');
        }
        $token = $consultant->token ?? null;
        $data = ['type' => 'Timesheet Submission', 'token' => $token, 'consultant' => $consultant, 'client' => DB::table('clients')->where('id', $consultant->client_id)->first(), 'consultancy' => DB::table('users')->where('id', $consultant->client_id)->first(), 'dashboards' => DB::table('consultant_dashboard')->where('user_id', $consultant->user_id)->where('type', 'timesheet')->where('status', 'Submitted')->get(), 'selectedYear' => $selectedYear, 'selectedMonth' => $selectedMonth, 'totalWorkingHours' => 0, 'isPdf' => false];
        foreach ($data['dashboards'] as $dashboard) {
            $record = json_decode($dashboard->record, true);
            if (!empty($record['workingHours'])) {
                $data['totalWorkingHours'] += floatval($record['workingHours']);
            }
        }
        return view('emails.claims_timesheet_reporting_manager_body', $data);
    }

    public function getAllSubmittedClaimsByUser($userId = 15)
    {
        $consultant = DB::table('consultants')->where('user_id', $userId)->first();
        $claimToken = $consultant->claim_token ?? null;

        // Fetch related client info
        $client = null;
        if (!empty($consultant->client_id)) {
            $client = DB::table('clients')->where('id', $consultant->client_id)->first();
        }

        // Fetch consultancy (user of the client)
        $consultancy = $client ? DB::table('users')->where('id', $client->user_id)->first() : null;

        // Fetch consultant's user data
        $user = DB::table('users')->where('id', $userId)->first();

        // Fetch submitted claims
        $records = DB::table('consultant_dashboard')
            ->where('user_id', $userId)
            ->where('status', 'Submitted')
            ->where('type', 'claims')
            ->orderBy('month_year')
            ->get();

        $claimsByMonth = [];

        foreach ($records as $record) {
            $decoded = json_decode($record->record, true);
            $entries = (is_array($decoded) && isset($decoded[0])) ? $decoded : (is_array($decoded) ? [$decoded] : []);

            foreach ($entries as $data) {
                if (!empty($data['applyOnCell'])) {
                    $dateStr = preg_replace('/\s*\/\s*/', '-', trim($data['applyOnCell']));

                    try {
                        $date = \Carbon\Carbon::createFromFormat('d-m-Y', $dateStr);
                    } catch (\Exception $e) {
                        continue;
                    }

                    $monthYear = $date->format('m_Y');
                    $day = (int)$date->format('d');

                    $claimsByMonth[$monthYear][$day][] = [
                        'id' => $record->id,
                        'type' => strtolower(trim($data['expenseType'] ?? 'other')),
                        'claim_no' => $data['claim_no'] ?? '',
                        'amount' => $data['amount'] ?? '',
                        'particulars' => $data['particulars'] ?? '',
                        'remarks' => $data['remarks'] ?? '',
                    ];
                }
            }
        }

        return view('emails.claims_timesheet_reporting_manager_body', [
            'claimsByMonth' => $claimsByMonth,
            'token' => $claimToken,
            'consultant' => $consultant,
            'client' => $client,
            'user' => $user,
            'consultancy' => $consultancy,
            'dashboards' => $records, // Add this if you want to extract parent_form_id later
        ]);
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

    public function getClaimsBlocks($userId, $monthYear = false) : array {
        if (!$monthYear) {
            $monthYear = now()->format('m_Y');
        }
        $selectedDate = \Carbon\Carbon::createFromFormat('m_Y', $monthYear);
        $allClaims = DB::table('consultant_dashboard')->where('user_id', $userId)->where('type', 'claims')->where('status', '!=', 'Draft')->whereNotNull('parent_form_id')->orderBy('parent_form_id')->get();
        $filteredClaims = $allClaims->filter(function ($claim) use ($selectedDate) {
            try {
                $claimDate = \Carbon\Carbon::createFromFormat('m_Y', $claim->month_year);
                return $claimDate->lt($selectedDate);
            }
            catch(\Exception $e) {
                return false;
            }
        })->groupBy('parent_form_id');
        $blocks = [];
        $currentBlock = 1;
        $formIndex = 0;
        foreach ($filteredClaims as $formId => $groupedClaims) {
            $blockKey = 'Blk ' . $currentBlock;
            if (!isset($blocks[$blockKey])) {
                $blocks[$blockKey] = ['1' => 0, 
                '2' => 0, 
                '3' => 0
                ];
            }
            foreach ($groupedClaims as $claim) {
                $record = json_decode($claim->record, true);
                $type = strtolower($record['expenseType'] ?? '');
                if ($type === 'taxi') {
                    $blocks[$blockKey]['1']++;
                }
                elseif ($type === 'dining') {
                    $blocks[$blockKey]['2']++;
                }
                else {
                    $blocks[$blockKey]['3']++;
                }
            }
            $formIndex++;
            if ($formIndex % 3 === 0) {
                $currentBlock++;
            }
        }
        return $blocks;
    }
    public function setMonthYear(Request $request) {
        $request->validate(['month' => 'required|integer|min:0|max:11', 
        'year' => 'required|integer|min:2000|max:2100', ]);
        $month = str_pad($request->month + 1, 2, '0', STR_PAD_LEFT); 
        $year = $request->year;
        $monthYear = $month . '_' . $year;
        session(['consultant_selected_month' => $month, 'consultant_selected_year' => $year, 'consultant_selected_month_year' => $monthYear, ]);
        return response()->json(['success' => true, 'message' => 'Month and year saved to session.', 'month_year' => $monthYear]);
    }

    public function showClaimsheet($userId, $month, $year) {
        $targetMonthYear = str_pad($month, 2, '0', STR_PAD_LEFT) . '_' . $year;
        $records = DB::table('consultant_dashboard')->where('user_id', $userId)->where('month_year', $targetMonthYear)->where('type', 'claims')->get();
        $claimDates = [];
        foreach ($records as $record) {
            $recordData = json_decode($record->record, true);
            if (!empty($recordData['applyOnCell'])) {
                $date = str_replace(' / ', '-', $recordData['applyOnCell']); 
                $parsed = Carbon::createFromFormat('d-m-Y', $date);
                if ($parsed && $parsed->month == $month && $parsed->year == $year) {
                    $claimDates[] = (int)$parsed->day;
                }
            }
        }
        $start = Carbon::createFromDate($year, $month, 1);
        $startDay = $start->dayOfWeekIso; 
        $daysInMonth = $start->daysInMonth;
        $calendar = [];
        $week = array_fill(0, 7, '');
        $day = 1;
        for ($i = $startDay - 1;$i < 7;$i++) {
            $week[$i] = $day++;
        }
        $calendar[] = $week;
        while ($day <= $daysInMonth) {
            $week = array_fill(0, 7, '');
            for ($i = 0;$i < 7 && $day <= $daysInMonth;$i++) {
                $week[$i] = $day++;
            }
            $calendar[] = $week;
        }
        return view('consultant.claims_timesheet_reporting_manager_body', ['calendarRows' => $calendar, 'claimDates' => $claimDates, 'selectedMonth' => str_pad($month, 2, '0', STR_PAD_LEFT), 'selectedYear' => $year, ]);
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

    public function getBackdatedClaimsData(Request $request) {
        $request->validate(['user_id' => 'required|integer|exists:users,id', ]);
        $userId = $request->input('user_id');
        $currentMonthYear = Carbon::now()->format('m_Y');
        $currentDate = Carbon::createFromFormat('m_Y', $currentMonthYear);
        $allClaims = DB::table('consultant_dashboard')->where('user_id', $userId)->where('type', 'claims')->where('status', '!=', 'Draft')->whereNotNull('parent_form_id')->orderBy('parent_form_id')->get();
        $filteredClaims = $allClaims->filter(function ($claim) use ($currentDate) {
            try {
                $claimDate = Carbon::createFromFormat('m_Y', $claim->month_year);
                return $claimDate->lt($currentDate);
            }
            catch(\Exception $e) {
                return false;
            }
        })->groupBy('parent_form_id');
        $blocks = [];
        $currentBlock = 1;
        $formIndex = 0;
        foreach ($filteredClaims as $formId => $groupedClaims) {
            $blockKey = 'Blk ' . $currentBlock;
            if (!isset($blocks[$blockKey])) {
                $blocks[$blockKey] = ['1' => 0, 
                '2' => 0, 
                '3' => 0, 
                ];
            }
            foreach ($groupedClaims as $claim) {
                $record = json_decode($claim->record, true);
                $type = strtolower($record['expenseType'] ?? '');
                if ($type === 'taxi') {
                    $blocks[$blockKey]['1']++;
                }
                elseif ($type === 'dining') {
                    $blocks[$blockKey]['2']++;
                }
                else {
                    $blocks[$blockKey]['3']++;
                }
            }
            $formIndex++;
            if ($formIndex % 3 === 0) {
                $currentBlock++;
            }
        }
        return response()->json(['success' => true, 'message' => count($blocks) > 0 ? 'Backdated claims data retrieved successfully.' : 'No backdated claims found.', 'data' => $blocks, ]);
    }

    


}