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
        $userData = Session::get('user_data');
        $userId = Session::get('user_data')['id'] ?? null;
        $consultant = Consultant::where('login_email',  $userData['email'])->first();
        //echo "<pre>";print_r($userData);die;
        if($userData['role_id'] == 11)
        {
            $dataTimesheet = DB::table('consultant_dashboard')
            ->where('user_id', $userId)
            ->where('type', 'timesheet')
            ->get();

            $dataClaims = DB::table('consultant_dashboard')
            ->where('user_id', $userId)
            ->where('type', 'claims')
            ->get();
           // echo "<pre>";print_r($dataTimesheet);die;
            return view('consultant.dashboard',compact('consultant','userData','dataTimesheet','dataClaims'));
        }
        else
        {
            return view('errors.404');
        }
        
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
            // 🛡️ If existing record is Submitted, force keep status = Submitted
            $finalStatus = ($match->status === 'Submitted') ? 'Submitted' : $status;
        
            DB::table('consultant_dashboard')
                ->where('id', $match->id)
                ->update([
                    'record' => json_encode($recordData),
                    'client_id' => $request->client_id,
                    'client_name' => $request->client_name,
                    'status' => $finalStatus, // ✅ Important: force keep 'Submitted' if already submitted
                    'updated_at' => now()
                ]);
        } else {
            // ➡️ New insert case
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
