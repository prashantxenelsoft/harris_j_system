<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultancy;
use App\Models\User;
use App\Models\Client;
use App\Models\UserManagment;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\TestMail;
use DB;


class ConsultancyApiController extends Controller
{
    public function __construct()
    {
        $this->data = include(resource_path('data/country_states.php'));
    }

    public function countries()
    {
        $countries = array_keys($this->data);

        return response()->json([
            'status' => true,
            'countries' => $countries
        ]);
    }

    public function getStates(Request $request)
    {
        $country = $request->query('country'); // URL se ?country=Afghanistan aayega

        if (!$country || !isset($this->data[$country])) {
            return response()->json([
                'status' => false,
                'message' => 'Country not found or missing.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'country' => $country,
            'states' => $this->data[$country]
        ]);
    }
    public function getConsultancy(Request $request)
    {
        $consultancies = Consultancy::orderBy('id', 'desc')->get();
    
        $formatted = $consultancies->map(function ($item) {
            $country = null;
            $flag = null;
    
            if (preg_match('/country:\s*([^,]+)/i', $item->full_address, $matches)) {
                $country = trim($matches[1]);
                $countryCode = strtolower($country); // e.g., 'Austria' => 'austria'
    
                // Use only first 2 letters (ISO might not match exactly, but this is your instruction)
                $code = substr($countryCode, 0, 2);
    
                // Optional: fallback logic if the code is not valid can be added
                $flag = "https://flagcdn.com/w80/{$code}.png";
            }
    
            $item->country = $country;
            $item->flag = $flag;
    
            return $item;
        });
    
        return response()->json([
            'status' => true,
            'message' => 'Consultancies fetched successfully',
            'data' => $formatted
        ], 200);
    }  

    public function add_consultancy(Request $request)
    {
        //echo "<pre>";print_r($request->all());die;
        $existingConsultancy = Consultancy::where('consultancy_id', $request->consultancy_id)->first();
        $existingConsultancyAdminEmail = Consultancy::where('admin_email', $request->admin_email)->first();
        $existingUserEmail = User::where('email', $request->admin_email)->first();

        if ($existingConsultancy || $existingConsultancyAdminEmail || $existingUserEmail) {
            $message = '';

            if ($existingConsultancy && $existingConsultancyAdminEmail && $existingUserEmail) {
                $message = 'Consultancy ID, Admin Email, and User Email already exist. Please use different values.';
            } elseif ($existingConsultancy && $existingConsultancyAdminEmail) {
                $message = 'Consultancy ID and Admin Email already exist. Please use different values.';
            } elseif ($existingConsultancy && $existingUserEmail) {
                $message = 'Consultancy ID and User Email already exist. Please use different values.';
            } elseif ($existingConsultancyAdminEmail && $existingUserEmail) {
                $message = 'Consultancy Admin Email and User Email already exist. Please use a different email.';
            } elseif ($existingConsultancy) {
                $message = 'Consultancy ID already exists. Please use a different ID.';
            } elseif ($existingConsultancyAdminEmail) {
                $message = 'Consultancy Admin Email already exists. Please use a different email.';
            } elseif ($existingUserEmail) {
                $message = 'User Email already exists. Please use a different email.';
            }

            return response()->json([
                'status' => 'error',
                'message' => $message
            ], 400);
        }

        $logoPath = null;

        if ($request->hasFile('consultancy_image')) {
            $image = $request->file('consultancy_image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('consultancy', $fileName, 'public');
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
            'created_by_user_id' => $request->user_id,
        ]);

        $userinsertedId = $user->id;

        DB::table('users_type')->insert([
            'user_id' => $userinsertedId,
            'unique_id' => $request->consultancy_id,
            'role_id' => 7,
        ]);

        if ($request->reset_password == 1) {
            $data = [
                'name' => $request->consultancy_name,
                'message' => 'Here is the important link you requested.',
                'url' => route('insert.password', ['id' => $userinsertedId])
            ];

            Mail::to($request->admin_email)->send(new TestMail($data));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Consultancy created successfully!'
        ]);
    }


}
