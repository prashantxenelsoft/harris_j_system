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

    public function addConsultantData(Request $request)
    {
        $recordData = json_decode($request->record, true);
        $applyOnCell = $recordData['applyOnCell'] ?? null;
        $incomingExpenseType = $recordData['expenseType'] ?? null;
        $type = $request->type;

        $match = null;

        // Fetch records for matching
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

        // Handle image replacement
        $oldImagePath = $match ? (json_decode($match->record, true)['certificate_path'] ?? null) : null;

        if ($request->hasFile('certificate')) {
            // ✅ Remove old image if it exists
            if ($oldImagePath && file_exists(base_path($oldImagePath))) {
                unlink(base_path($oldImagePath));
            }

            // ✅ Store new image in the same folder as your original logic
            $image = $request->file('certificate');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('consultant', $fileName); // This stores to storage/app/consultant
            $recordData['certificate_path'] = 'storage/app/public/consultant/' . $fileName; // You wanted this exact format
        } elseif (!$request->hasFile('certificate') && !$match) {
            $recordData['certificate_path'] = null;
        } elseif (!$request->hasFile('certificate') && $match) {
            $recordData['certificate_path'] = $oldImagePath;
        }

        // ✅ Insert or update record
        if ($match) {
            DB::table('consultant_dashboard')
                ->where('id', $match->id)
                ->update([
                    'record' => json_encode($recordData),
                    'client_id' => $request->client_id,
                    'client_name' => $request->client_name,
                    'updated_at' => now()
                ]);
        } else {
            DB::table('consultant_dashboard')->insert([
                'type' => $type,
                'record' => json_encode($recordData),
                'user_id' => $request->user_id,
                'client_id' => $request->client_id,
                'client_name' => $request->client_name,
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
