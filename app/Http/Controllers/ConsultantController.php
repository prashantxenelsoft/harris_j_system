<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Consultant;
use DB;

class ConsultantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUrl = url()->full(); 
        $userData = Session::get('user_data');
        $userId = Session::get('user_data')['id'] ?? null;
        $consultant = Consultant::where('login_email',  $userData['email'])->first();
        //echo "<pre>";print_r($userData);die;
        if($userData['role_id'] == 11)
        {
          $feedbacksgData = DB::table('feedbacks')
          ->where('sender_id', $userId)
          ->get();

          $leaveLogData = DB::table('leave_log')
          ->where('user_id', $userId)
          ->first();

            $dataTimesheet = DB::table('consultant_dashboard')
            ->where('user_id', $userId)
            ->where('type', 'timesheet')
            ->orderBy('id', 'desc')
            ->get();
           // echo "<pre>";print_r($dataTimesheet);die;

            $dataClaims = DB::table('consultant_dashboard')
            ->where('user_id', $userId)
            ->where('type', 'claims')
            ->orderBy('id', 'desc')
            ->get();
            $publicHolidays = DB::table('public_holidays')->get();

            //echo "<pre>";print_r($feedbacksgData);die;
            
            return view('consultant.dashboard',compact('consultant','userData','dataTimesheet','dataClaims','publicHolidays','leaveLogData','feedbacksgData'));
        }
        else
        {
            return view('errors.404');
        }
        
    }

    public function updateBasicDetailsConsultant(Request $request)
    {
        $consultant = Consultant::findOrFail($request->id);

        $consultant->fill($request->only([
            'first_name', 'middle_name', 'last_name', 'dob',
            'citizen', 'nationality', 'address_by_user', 'mobile_number'
        ]));

        // 🔄 Handle Profile Image Upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if it exists
            if ($consultant->profile_image && file_exists(public_path('storage/' . $consultant->profile_image))) {
                unlink(public_path('storage/' . $consultant->profile_image));
            }

            $image = $request->file('profile_image');
            $fileName = time() . '_profile_' . $image->getClientOriginalName();
            $image->storeAs('consultant', $fileName, 'public');
            $consultant->profile_image = 'consultant/' . $fileName;
        }

        // 🔄 Handle Resume Upload
        if ($request->hasFile('resume_file')) {
            // Delete old resume if it exists
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

    public function information()
    {
        $userData = Session::get('user_data');
        $userId = Session::get('user_data')['id'] ?? null;
        $consultant = Consultant::where('login_email',  $userData['email'])->first();
        return view('consultant.basic_info_page',compact('consultant'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getTimesheetStatus(Request $request)
    {
        $userId = auth()->id();
        $month = (int) $request->query('month') + 1;
        $year = (int) $request->query('year');  
        $entries = DB::table('consultant_dashboard')
            ->where('user_id', $userId)
            ->where('type', 'timesheet')
            ->get();

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

        // Now check status values
        $statuses = $filtered->pluck('status')->map(fn($s) => strtolower(trim($s)));

        if ($statuses->contains('draft')) {
            return response()->json(['status' => 'draft']);
        }

        if ($statuses->every(fn($s) => $s === 'submitted')) {
            return response()->json(['status' => 'submitted']);
        }

        // fallback — mixed or unknown status
        return response()->json(['status' => null]);
    }

    public function getTimesheetStatusReportingManager(Request $request)
    {

        $userId = (int) $request->query('user_id');
        $month = (int) $request->query('month') + 1;
        $year = (int) $request->query('year');  
        $entries = DB::table('consultant_dashboard')
            ->where('user_id', $userId)
            ->where('type', 'timesheet')
            ->get();

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

        // Now check status values
        $statuses = $filtered->pluck('status')->map(fn($s) => strtolower(trim($s)));

        if ($statuses->contains('draft')) {
            return response()->json(['status' => 'draft']);
        }

        if ($statuses->every(fn($s) => $s === 'submitted')) {
            return response()->json(['status' => 'submitted']);
        }

        // fallback — mixed or unknown status
        return response()->json(['status' => null]);

    }

    public function getClaimStatus(Request $request)
    {
        $userId = auth()->id();
        $month = (int) $request->query('month') + 1;
        $year = (int) $request->query('year');  
        $entries = DB::table('consultant_dashboard')
            ->where('user_id', $userId)
            ->where('type', 'claims')
            ->get();

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

        // Now check status values
        $statuses = $filtered->pluck('status')->map(fn($s) => strtolower(trim($s)));

        if ($statuses->contains('draft')) {
            return response()->json(['status' => 'draft']);
        }

        if ($statuses->every(fn($s) => $s === 'submitted')) {
            return response()->json(['status' => 'submitted']);
        }

        // fallback — mixed or unknown status
        return response()->json(['status' => null]);
    }

    public function addConsultantData(Request $request)
    {
        $recordData = json_decode($request->record, true);
        $applyOnCell = $recordData['applyOnCell'] ?? null;
        $incomingExpenseType = $recordData['expenseType'] ?? null;
        $type = $request->type;
        $status = $request->status ?? 'Draft';

        // ✅ Delete overlapping workingHours entries if date range exists
        if (!empty($recordData['date']) && strpos($recordData['date'], 'to') !== false) {
            $rangeParts = explode(' to ', $recordData['date']);
            if (count($rangeParts) === 2) {
                try {
                    $start = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[0]));
                    $end = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[1]));

                    while ($start->lte($end)) {
                        $formattedDate = $start->format('d / m / Y');
                    
                        // ✅ Get all rows to be deleted first
                        $rowsToDelete = DB::table('consultant_dashboard')
                            ->where('type', 'timesheet')
                            ->where('user_id', $request->user_id)
                            ->whereJsonContains('record->applyOnCell', $formattedDate)
                            // ->whereJsonContains('record->workingHours', '8') // optional if needed
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

        $match = null;

        // 🔍 Check if an exact match exists (for update)
        $existingRecords = DB::table('consultant_dashboard')
            ->where('type', $type)
            ->where('user_id', $request->user_id)
            ->get();

        foreach ($existingRecords as $row) {
            $decoded = json_decode($row->record, true);
            if (
                ($type === 'timesheet' && !empty($decoded['applyOnCell']) && $decoded['applyOnCell'] === $applyOnCell) ||
                ($type === 'claims' &&
                    !empty($decoded['expenseType']) && $decoded['expenseType'] === $incomingExpenseType &&
                    !empty($decoded['applyOnCell']) && $decoded['applyOnCell'] === $applyOnCell)
            ) {
                $match = $row;
                break;
            }
        }

        // 🖼 Handle image
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

        // ✅ Insert or Update
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
            }
        }
        else {
            // 🔁 Same-month status update before inserting
            try {
                $applyDate = \Carbon\Carbon::createFromFormat('d / m / Y', $applyOnCell);
                $month = $applyDate->format('m');
                $year = $applyDate->format('Y');

                $sameMonthRecords = DB::table('consultant_dashboard')
                    ->where('type', $type)
                    ->where('user_id', $request->user_id)
                    ->get();

                foreach ($sameMonthRecords as $row) {
                    $decoded = json_decode($row->record, true);
                    $cellDate = $decoded['applyOnCell'] ?? null;

                    if ($cellDate) {
                        try {
                            $cellDateCarbon = \Carbon\Carbon::createFromFormat('d / m / Y', trim($cellDate));
                            if ($cellDateCarbon->format('m') === $month && $cellDateCarbon->format('Y') === $year) {
                                DB::table('consultant_dashboard')
                                    ->where('id', $row->id)
                                    ->update([
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
                \Log::error("Month status sync before insert failed: " . $e->getMessage());
            }

            // ➡️ Now insert
            DB::table('consultant_dashboard')->insert([
                'type' => $type,
                'record' => json_encode($recordData),
                'user_id' => $request->user_id,
                'client_id' => $request->client_id,
                'client_name' => $request->client_name,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        

        return response()->json(['success' => true, 'message' => 'Data saved successfully!']);
    }

    
    public function deleteClaim(Request $request)
    {
        $id = $request->id;

        // Fetch the record to get the image path
        $record = DB::table('consultant_dashboard')->where('id', $id)->first();

        if ($record) {
            $decoded = json_decode($record->record, true);
            $imagePath = $decoded['certificate_path'] ?? null;

            // Remove image from filesystem if it exists
            if ($imagePath) {
                $fullPath = base_path($imagePath); // Use base_path to match how you stored it
                if (file_exists($fullPath)) {
                    @unlink($fullPath); // suppress error in case file already gone
                }
            }

            // Delete the record from the database
            $deleted = DB::table('consultant_dashboard')->where('id', $id)->delete();

            return response()->json([
                'success' => $deleted > 0,
                'message' => 'Claim deleted successfully (image removed if existed).'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Claim not found.'
        ]);
    }


    // In ConsultantController.php

   public function updateTimesheetStatus(Request $request, $id)
    {
        $month = (int) $request->query('month'); 
        $year = (int) $request->query('year');   
        $user_id = $id;

        $user_data = DB::table('users')
            ->where('id', $id)
            ->where('status', 'Active')
            ->first(['email']);

        if (!$user_data || empty($user_data->email)) {
            abort(404);
        }

        $publicHolidays = DB::table('public_holidays')->get();

        $consultant = Consultant::where('login_email', $user_data->email)->first();

        $allRows = DB::table('consultant_dashboard')
            ->where('user_id', $id)
            ->where('type', 'timesheet')
            ->where('status', 'Submitted')
            ->orderBy('id', 'desc')
            ->get();

        $dataTimesheet = $allRows->filter(function ($row) use ($month, $year) {
            $record = json_decode($row->record ?? '{}', true);
            $applyOnCell = $record['applyOnCell'] ?? null;

            if ($applyOnCell) {
                try {
                    $date = \Carbon\Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                    return $date->month == $month && $date->year == $year;
                } catch (\Exception $e) {
                    return false;
                }
            }
            return false;
        })->values();

        //echo "<pre>";print_r($dataTimesheet);die;

        // ❌ Return 404 if any of the required parts are missing
        if ($dataTimesheet->isEmpty() || !$consultant || $publicHolidays->isEmpty()) {
            abort(404);
        }

        return view('consultant.Reporting_manager_approval_page', compact('dataTimesheet', 'consultant', 'publicHolidays','user_id'));
    }



   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
