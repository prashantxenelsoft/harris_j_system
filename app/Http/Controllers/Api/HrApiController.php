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

    public function updateConsultant(Request $request)
    {
        $consultantId = $request->edit_id;

        if (!$consultantId || !DB::table('consultants')->where('id', $consultantId)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Consultant not found.',
            ], 404);
        }

        // Check duplicate consultant email
        if ($request->email) {
            $exists = DB::table('consultants')
                ->where('email', $request->email)
                ->where('id', '!=', $consultantId)
                ->exists();

            if ($exists) {
                return response()->json([
                    'status' => false,
                    'message' => 'The entered consultant email already exists.',
                ], 409);
            }
        }

        // Check duplicate login email
        if ($request->login_email) {
            $exists = DB::table('users')
                ->where('email', $request->login_email)
                ->whereNotIn('id', function ($query) use ($consultantId) {
                    $query->select('user_id')->from('consultants')->where('id', $consultantId);
                })
                ->exists();

            if ($exists) {
                return response()->json([
                    'status' => false,
                    'message' => 'This login email is already registered.',
                ], 409);
            }
        }

        // Prepare update data
        $data = $request->except(['_token', 'profile_image', 'edit_id']);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('consultants/profile', 'public');
        }

        $clientId = $data['client_id'] ?? null;
        $clientName = DB::table('clients')->where('id', $clientId)->value('serving_client');
        $data['client_name'] = $clientName;

        // Update consultants table
        DB::table('consultants')->where('id', $consultantId)->update($data);

        // Also update related user
        $consultant = DB::table('consultants')->where('id', $consultantId)->first();
        if ($consultant && $consultant->user_id) {
            User::where('id', $consultant->user_id)->update([
                'name' => $data['emp_name'] ?? '',
                'email' => $data['login_email'] ?? '',
                'status' => $data['status'] ?? 'Active',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Consultant updated successfully.',
            'consultant_id' => $consultantId,
        ]);
    }

    public function deleteConsultant(Request $request)
    {
        $consultantId = $request->consultant_id;

        if (!$consultantId) {
            return response()->json([
                'status' => false,
                'message' => 'Consultant ID is required.',
            ], 400);
        }

        $consultant = DB::table('consultants')->where('id', $consultantId)->first();

        if (!$consultant) {
            return response()->json([
                'status' => false,
                'message' => 'Consultant not found.',
            ], 404);
        }

        // Optionally delete user as well
        if ($consultant->user_id) {
            User::where('id', $consultant->user_id)->delete();
        }

        // Delete consultant
        DB::table('consultants')->where('id', $consultantId)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Consultant deleted successfully.',
        ]);
    }

    public function clientListing(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access.'
            ], 401);
        }

        // Get all clients created by the user's creator
        $clients = DB::table('clients')
            ->where('user_id', $user->created_by_user_id)
            ->select('*')
            ->orderBy('serving_client')
            ->get();

        if ($clients->isEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'No clients found.',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Client list fetched successfully.',
            'data' => $clients
        ]);
    }

    public function consultantInformation(Request $request)
    {
        $consultantId = $request->consultant_id;

        if (!$consultantId) {
            return response()->json([
                'status' => false,
                'message' => 'Consultant ID is required.'
            ], 400);
        }

        $consultant = DB::table('consultants')
            ->leftJoin('clients', 'consultants.client_id', '=', 'clients.id')
            ->leftJoin('users', 'consultants.user_id', '=', 'users.id')
            ->where('consultants.id', $consultantId)
            ->select(
                'consultants.*',
                'clients.serving_client as client_name',
                'users.name as login_user_name',
                'users.email as login_user_email',
                'users.status as user_status'
            )
            ->first();

        if (!$consultant) {
            return response()->json([
                'status' => false,
                'message' => 'Consultant not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Consultant information fetched successfully.',
            'data' => $consultant
        ]);
    }





}
