<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultancy;
use App\Models\User;
use Illuminate\Support\Str;
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
use Illuminate\Support\Facades\Log;
use App\Mail\TestMail;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
class HrApiController extends Controller
{

  public function addConsultant(Request $request)
    {
        echo "<pre>";print_r($request->all());die;
        $request->validate([
            'emp_name' => 'required|string|max:100',
            'emp_code' => 'nullable|string|max:50',
            'sex' => 'nullable|string',
            'dob' => 'nullable|date',
            'mobile_number_code' => 'nullable|string|max:10',
            'mobile_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'profile_image' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
            'full_address' => 'nullable|string',
            'show_address_input' => 'nullable|string',
            'joining_date' => 'nullable|date',
            'resignation_date' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'select_holiday' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'login_email' => 'nullable|email|max:100',
            'reset_password' => 'nullable|in:0,1',
            'client_id' => 'nullable|integer|exists:clients,id',
        ]);

        // Check duplicate consultant email
        if ($request->email && DB::table('consultants')->where('email', $request->email)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'The entered consultant email already exists.',
            ], 409);
        }

        // Check duplicate login email
        if (DB::table('users')->where('email', $request->login_email)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'This login email is already registered.',
            ], 409);
        }

        // Prepare insert data
        $data = $request->except(['_token', 'profile_image', 'edit_id']);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('consultants/profile', 'public');
        }

        $clientId = $data['client_id'] ?? null;
        $clientName = DB::table('clients')->where('id', $clientId)->value('serving_client');

        // Insert into consultants
        $consultantId = DB::table('consultants')->insertGetId(array_merge($data, [
            'user_id' => null,
            'client_name' => $clientName
        ]));

        // Create user for consultant
        $user = User::create([
            'name'     => $data['emp_name'],
            'email'    => $data['login_email'],
            'role_id'  => 11,
            'status'   => $data['status'] ?? 'Active',
            'created_by_user_id' => auth()->id(),
        ]);

        // Update consultant with user_id
        DB::table('consultants')->where('id', $consultantId)->update([
            'user_id' => $user->id
        ]);

        // Send reset password email if required
        if ($request->reset_password == 1) {
            $emailData = [
                'name' => $request->emp_name,
                'message' => 'Here is your link to set your password.',
                'url' => route('insert.password', ['id' => $user->id])
            ];
            Mail::to($request->login_email)->send(new TestMail($emailData));
        }

        return response()->json([
            'status' => true,
            'message' => 'Consultant added successfully.',
            'consultant_id' => $consultantId,
            'user_id' => $user->id
        ]);
    }

}
