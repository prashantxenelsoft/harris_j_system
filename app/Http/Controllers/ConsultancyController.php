<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultancy;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\TestMail;
use DB;

class ConsultancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Consultancy ID unique hone ka manual check
        $existingConsultancy = Consultancy::where('consultancy_id', $request->consultancy_id)->first();

        if ($existingConsultancy) {
            return response()->json([
                'status' => 'error',
                'message' => 'Consultancy ID already exists. Please use a different ID.'
            ], 400);
        }

        $logoPath = null;

        if ($request->hasFile('consultancy_image')) {
            $image = $request->file('consultancy_image');
            $fileName = time() . '_' . $image->getClientOriginalName();
        
            $path = $image->storeAs('consultancy', $fileName);
        
            $logoPath = 'storage/app/public/consultancy/' . $fileName;
        }
        $consultancy = Consultancy::create([
            'consultancy_name' => $request->consultancy_name,
            'consultancy_id' => $request->consultancy_id,
            'uen_number' => $request->uen_number,
            'consultancy_logo' => $logoPath,
            'full_address' => $request->full_address,
            'show_address_input' => $request->show_address_input,
            'primary_contact' => $request->primary_contact,
            'primary_mobile' => $request->primary_mobile,
            'primary_email' => $request->primary_email,
            'secondary_contact' => $request->secondary_contact,
            'secondary_email' => $request->secondary_email,
            'secondary_mobile' => $request->secondary_mobile,
            'consultancy_type' => $request->consultancy_type,
            'consultancy_status' => $request->consultancy_status,
            'license_start_date' => $request->license_start_date,
            'license_end_date' => $request->license_end_date,
            'license_number' => $request->license_number,
            'fees_structure' => $request->fees_structure,
            'last_paid_status' => $request->last_paid_status,
            'admin_email' => $request->admin_email,
            'primary_mobile_country_code' => $request->primary_mobile_country_code,
            'secondary_mobile_country_code' => $request->secondary_mobile_country_code,
            'reset_password' => $request->reset_password,
        ]);

        $user = User::create([
            'name' => $request->consultancy_name,
            'email' => $request->admin_email,
            'role_id' => 7,
            'status' => $request->consultancy_status,
        ]);
        $userinsertedId = $user->id;
        DB::table('users_type')->insert([
            'user_id' => $userinsertedId,
            'unique_id' => $request->consultancy_id,
            'role_id' => 7,
        ]);
        $insertedId = $consultancy->id;
        if($request->reset_password == 1)
        {
            $data = [
                'name' => $request->consultancy_name,
                'message' => 'Here is the important link you requested.',
                'url' => route('insert.password', ['id' => $insertedId]) // You can replace this with any dynamic URL
            ];
    
            Mail::to('prashantxenelsoft@gmail.com')->send(new TestMail($data));
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Consultancy created successfully!'
        ]);
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
        if (Consultancy::where('consultancy_id', $request->consultancy_id)->where('id', '!=', $id)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'Consultancy ID already exists.'], 400);
        }
    
        $consultancy = Consultancy::find($request->edit_id);
        if (!$consultancy) {
            return response()->json(['status' => false, 'message' => 'Consultancy not found!']);
        }
    
        DB::table('users_type')->where('unique_id', $consultancy->consultancy_id)->update(['unique_id' => $request->consultancy_id]);
    
        $user = DB::table('users_type')->where('unique_id', $consultancy->consultancy_id)
            ->join('users', 'users.id', '=', 'users_type.user_id')->select('users.*')->first();
    
        if ($user) {
            User::where('id', $user->id)->update(['status' => $request->consultancy_status]);
        }
    
        $requestData = $request->except(['_token', '_method', 'edit_id']);
    
        // ✅ Handle new image upload
        if ($request->hasFile('consultancy_image')) {
            $image = $request->file('consultancy_image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('consultancy', $fileName); // uploads to storage/app/public/consultancy
    
            // ✅ Delete old image if exists
            if ($consultancy->consultancy_logo) {
                $oldPath = str_replace('storage/app/public/', '', $consultancy->consultancy_logo); // gives consultancy/filename.png
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
    
            $requestData['consultancy_logo'] = 'storage/app/public/consultancy/' . $fileName;
        }
    
        $consultancy->update($requestData);
    
        // ✅ Optional mail
        if ($request->reset_password) {
            Mail::to('prashantxenelsoft@gmail.com')->send(new TestMail([
                'name' => $request->consultancy_name,
                'message' => 'Here is the important link you requested.',
                'url' => route('insert.password', ['id' => $request->edit_id])
            ]));
        }
    
        return response()->json([
            'status' => true,
            'message' => 'Consultancy updated successfully!',
            'data' => $consultancy
        ]);
    }
    
    

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $consultancy = Consultancy::findOrFail($id);
    
        if ($consultancy->consultancy_logo) {

            $logoPath = str_replace('storage/app/public/', '', $consultancy->consultancy_logo);
    
            if (Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
        }
        $consultancy->delete();
    
        return response()->json(['status' => true, 'message' => 'Consultancy deleted successfully.']);
    }
    
    public function insertPassword(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $consultancy = Consultancy::find($id);
    
            if (!$consultancy) {
                return back()->with('error', 'Consultancy not found');
            }
    
            $user = DB::table('users_type')
                ->where('unique_id', $consultancy->consultancy_id)
                ->join('users', 'users.id', '=', 'users_type.user_id')
                ->select('users.*')
                ->first();
    
            if (!$user) {
                return back()->with('error', 'User not found');
            }
    
            User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
    
            return back()->with('success', 'Password updated successfully');
        }
    
        return view('consultancy.insert-password', compact('id'));
    }
    

    // public function sendTestEmail()
    // {
    //     $data = [
    //         'name' => 'John Doe',
    //         'message' => 'Here is the important link you requested.',
    //         'url' => url('/special-page') // You can replace this with any dynamic URL
    //     ];

    //     Mail::to('prashantxenelsoft@gmail.com')->send(new TestMail($data));

    //     echo  "Email with a URL has been sent successfully!";
    // }

    public function storeLookup(Request $request)
    {
        // JSON Encode lookup data
        $lookupData = json_encode([
            'property_name' => $request->property_name,
            'property_description' => $request->property_description,
            'color' => $request->color,
            'status' => $request->status ? 1 : 0, // Convert checkbox value
        ]);

        // Insert into database and get ID
        $id = DB::table('bom_static_settings')->insertGetId([
            'lookup_header' => $lookupData,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Decode JSON data to return as response
        $decodedData = json_decode($lookupData, true);

        return response()->json([
            'id' => $id,
            'property_name' => $decodedData['property_name'],
            'property_description' => $decodedData['property_description'],
            'color' => $decodedData['color'],
            'status' => $decodedData['status'],
        ]);
    }

    public function updateLookup(Request $request)
    {
    
        $existingData = DB::table('bom_static_settings')
            ->where('id', $request->id)
            ->value('lookup_header');
    
        // Decode the existing JSON data
        $lookupData = json_decode($existingData, true);
    
        // Update fields in the lookup header
        $lookupData['property_name'] = $request->property_name;
        $lookupData['property_description'] = $request->property_description;
        $lookupData['status'] = $request->status;
        $lookupData['color'] = $request->color; 
    
        // Encode back to JSON and update the database
        DB::table('bom_static_settings')
            ->where('id', $request->id)
            ->update(['lookup_header' => json_encode($lookupData)]);
    
        return response()->json([
            'success' => true,
            'message' => 'Record updated successfully',
            'data' => $lookupData
        ]);
    }

    public function destroylookupHeader($id)
    {
        $deleted = DB::table('bom_static_settings')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Record deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Record not found!']);
    }

    public function storelookup_option(Request $request)
    {
        //echo "<pre>";print_r($request->all());die;
        $lookupData_option = json_encode([
            'property_name' => $request->property_name,
            'option_name' => $request->option_name,
            'option_description' => $request->option_description,
            'option_value1' => $request->option_value1,
            'sequence' => $request->sequence,
            'color_hex' => $request->color_hex,
            'status' => $request->status ? 1 : 0, // Convert checkbox value
            'visibility' => $request->visibility ? 1 : 0, // Convert checkbox value
        ]);

          // Insert into database and get ID
          $id = DB::table('bom_static_settings')->insertGetId([
            'lookup_option' => $lookupData_option,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Decode JSON data to return as response
        $decodedData = json_decode($lookupData_option, true);
        
        return response()->json([
            'id' => $id,
            'property_name' => $decodedData['property_name'],
            'option_name' => $decodedData['option_name'],
            'option_description' => $decodedData['option_description'],
            'option_value1' => $decodedData['option_value1'],
            'sequence' => $decodedData['sequence'],
            'color_hex' => $decodedData['color_hex'],
            'status' => $decodedData['status'],
            'visibility' => $decodedData['visibility'],
        ]);
    }

    public function destroylookupOption($id)
    {
        $deleted = DB::table('bom_static_settings')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Record deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Record not found!']);
    }

    public function updateLookupOption(Request $request)
    {
        // Retrieve existing JSON data from the database for the given ID
        $existingData = DB::table('bom_static_settings')
            ->where('id', $request->id)
            ->value('lookup_option');
        
        // Decode the existing JSON data
        $lookupData = json_decode($existingData, true);
        
        // Update the fields in the lookup option
        $lookupData['property_name'] = $request->property_name;
        $lookupData['option_name'] = $request->option_name;
        $lookupData['option_description'] = $request->option_description;
        $lookupData['option_value1'] = $request->option_value1;
        $lookupData['sequence'] = $request->sequence;
        $lookupData['color'] = $request->color;
        $lookupData['status'] = $request->status;
        $lookupData['visibility'] = $request->visibility;

       // echo "<pre>";print_r($lookupData);die;
        
        // Encode back to JSON and update the database
        DB::table('bom_static_settings')
            ->where('id', $request->id)
            ->update(['lookup_option' => json_encode($lookupData)]);
        
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Record updated successfully',
            'data' => $lookupData
        ]);
    }
    


}
