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
            ->where('consultant_id', $userId)
            ->where('type', 'timesheet')
            ->get();

            $dataClaims = DB::table('consultant_dashboard')
            ->where('consultant_id', $userId)
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
    
        // Image upload logic
        if ($request->hasFile('certificate')) {
            $image = $request->file('certificate');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('consultant', $fileName);
            $logoPath = 'storage/app/public/consultant/' . $fileName;
            $recordData['certificate_path'] = $logoPath; // Include image path in record
        }
        $applyOnCell = $recordData['applyOnCell'] ?? null;
        if($request->type == "timesheet")
        {
            if ($applyOnCell) {
                // Fetch all matching timesheet records for this consultant
                $existingRecords = DB::table('consultant_dashboard')
                    ->where('type', 'timesheet')
                    ->where('consultant_id', $request->consultant_id)
                    ->get();
            
                $match = null;
            
                foreach ($existingRecords as $row) {
                    $decoded = json_decode($row->record, true);
                    if (!empty($decoded['applyOnCell']) && $decoded['applyOnCell'] === $applyOnCell) {
                        $match = $row;
                        break;
                    }
                }
            
                if ($match) {
                    // Update existing record
                    DB::table('consultant_dashboard')
                        ->where('id', $match->id)
                        ->update([
                            'record' => json_encode($recordData),
                            'client_id' => $request->client_id,
                            'client_name' => $request->client_name,
                            'updated_at' => now()
                        ]);
                } else {
                    // Insert new record
                    DB::table('consultant_dashboard')->insert([
                        'type' => $request->type,
                        'record' => json_encode($recordData),
                        'consultant_id' => $request->consultant_id,
                        'client_id' => $request->client_id,
                        'client_name' => $request->client_name,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
        else
        {
            if ($applyOnCell) {
                // Fetch all matching timesheet records for this consultant
                $existingRecords = DB::table('consultant_dashboard')
                    ->where('type', 'claims')
                    ->where('consultant_id', $request->consultant_id)
                    ->get();
            
                $match = null;
            
                foreach ($existingRecords as $row) {
                    $decoded = json_decode($row->record, true);
                    if (!empty($decoded['applyOnCell']) && $decoded['applyOnCell'] === $applyOnCell) {
                        $match = $row;
                        break;
                    }
                }
            
                if ($match) {
                    // Update existing record
                    DB::table('consultant_dashboard')
                        ->where('id', $match->id)
                        ->update([
                            'record' => json_encode($recordData),
                            'client_id' => $request->client_id,
                            'client_name' => $request->client_name,
                            'updated_at' => now()
                        ]);
                } else {
                    // Insert new record
                    DB::table('consultant_dashboard')->insert([
                        'type' => $request->type,
                        'record' => json_encode($recordData),
                        'consultant_id' => $request->consultant_id,
                        'client_id' => $request->client_id,
                        'client_name' => $request->client_name,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

        }
    
        return response()->json(['success' => true, 'message' => 'Timesheet saved successfully!']);
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
