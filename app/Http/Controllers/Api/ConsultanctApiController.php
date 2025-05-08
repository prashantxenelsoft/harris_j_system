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


class ConsultanctApiController extends Controller
{
    
    public function apiUpdateBasicDetailsConsultant(Request $request)
    {
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
    
        // 🔄 Handle Profile Image Upload
        if ($request->hasFile('profile_image')) {
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
    

}
