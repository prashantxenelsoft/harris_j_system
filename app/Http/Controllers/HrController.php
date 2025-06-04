<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Hr;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use App\Models\Consultant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\TestMail;
class HrController extends Controller {
    public function index() {
        $user = Auth::user();
        if (!$user) {
            return view('errors.404');
        }
         $consultants = DB::table('consultants')
        ->leftJoin('clients', 'consultants.client_id', '=', 'clients.id') // if using foreign key
        ->select(
            'consultants.*',
            'clients.serving_client as client_name'
        )
        ->orderBy('consultants.id', 'desc')
        ->get();
        
        //$data = $this->getFullUserHierarchyIncludingAbove($user->id, $user->role_id);
        $clients = Client::all();
        //echo "<pre>";print_r($clients);die;
        
        return view('hr.index', [
            'userData'      => $user,
            // 'consultancies' => $data['consultancies'],
            // 'hrs'           => $data['hrs'],
            'clients'       => $clients,
            'consultants'   => $consultants
        ]);
    }
    public function getFullUserHierarchyIncludingAbove($userId, $roleId) {
        $consultancies = collect();
        $clients = collect();
        $hrs = collect();
        $consultants = collect();
        $current = DB::table('users')->where('id', $userId)->first();
        while ($current && $current->created_by_user_id) {
            $parent = DB::table('users')->where('id', $current->created_by_user_id)->first();
            if ($parent) {
                if ($parent->role_id == 6) {
                    break; 
                }
                $current = $parent;
            } else {
                break;
            }
        }
        if ($current && $current->role_id == 6) {
            return $this->getFullUserHierarchy($current->id, 6);
        }
        return $this->getFullUserHierarchy($userId, $roleId);
    }
    public function getFullUserHierarchy($userId, $roleId) {
        $consultancies = collect();
        $clients = collect();
        $hrs = collect();
        $consultants = collect();
        $baseUser = DB::table('users')->where('id', $userId)->where('status', 'Active')->first();
        if (!$baseUser) {
            return [
                'consultancies' => $consultancies,
                'clients' => $clients,
                'hrs' => $hrs,
                'consultants' => $consultants
            ];
        }
        switch ($roleId) {
            case 6: 
                $consultancies = DB::table('users')
                    ->where('role_id', 7)
                    ->where('created_by_user_id', $userId)
                    ->where('status', 'Active')
                    ->orderBy('id', 'desc')
                    ->get();
                foreach ($consultancies as $consultancy) {
                    $hrs = $hrs->merge(DB::table('users')
                        ->where('role_id', 8)
                        ->where('created_by_user_id', $consultancy->id)
                        ->where('status', 'Active')
                        ->orderBy('id', 'desc')
                        ->get());
                    $clients = $clients->merge(DB::table('users')
                        ->where('role_id', 9)
                        ->where('created_by_user_id', $consultancy->id)
                        ->where('status', 'Active')
                        ->orderBy('id', 'desc')
                        ->get());
                }
                foreach ($hrs as $hr) {
                    $consultants = $consultants->merge(
                        DB::table('users')
                            ->leftJoin('consultants', 'consultants.user_id', '=', 'users.id')
                            ->where('users.role_id', 11)
                            ->where('users.created_by_user_id', $hr->id)
                            ->where('users.status', 'Active')
                            ->select('users.*', 'consultants.joining_date', 'consultants.designation', 'consultants.emp_code', 'consultants.profile_image')
                            ->orderBy('users.id', 'desc')
                            ->get()
                    );
                }
                break;
            case 7: 
                $consultancies = collect([$baseUser]);
                $hrs = DB::table('users')
                    ->where('role_id', 8)
                    ->where('created_by_user_id', $userId)
                    ->where('status', 'Active')
                    ->orderBy('id', 'desc')
                    ->get();
                $clients = DB::table('users')
                    ->where('role_id', 9)
                    ->where('created_by_user_id', $userId)
                    ->where('status', 'Active')
                    ->orderBy('id', 'desc')
                    ->get();
                foreach ($hrs as $hr) {
                    $consultants = $consultants->merge(
                        DB::table('users')
                            ->leftJoin('consultants', 'consultants.user_id', '=', 'users.id')
                            ->where('users.role_id', 11)
                            ->where('users.created_by_user_id', $hr->id)
                            ->where('users.status', 'Active')
                            ->select('users.*', 'consultants.joining_date', 'consultants.designation', 'consultants.emp_code', 'consultants.profile_image')
                            ->orderBy('users.id', 'desc')
                            ->get()
                    );
                }
                $bom = DB::table('users')
                    ->where('id', $baseUser->created_by_user_id)
                    ->where('role_id', 6)
                    ->where('status', 'Active')
                    ->orderBy('id', 'desc')
                    ->first();
                if ($bom) {
                    $consultancies = $consultancies->prepend($bom);
                }
                break;
            case 8: 
                $hrs = collect([$baseUser]);
                $consultants = DB::table('users')
                    ->leftJoin('consultants', 'consultants.user_id', '=', 'users.id')
                    ->where('users.role_id', 11)
                    ->where('users.created_by_user_id', $userId)
                    ->where('users.status', 'Active')
                    ->select('users.*', 'consultants.joining_date', 'consultants.designation', 'consultants.emp_code', 'consultants.profile_image')
                    ->orderBy('users.id', 'desc')
                    ->get();
                $consultancy = DB::table('users')
                    ->where('id', $baseUser->created_by_user_id)
                    ->where('role_id', 7)
                    ->where('status', 'Active')
                    ->orderBy('id', 'desc')
                    ->first();
                if ($consultancy) {
                    $consultancies = collect([$consultancy]);
                    $clients = DB::table('users')
                        ->where('role_id', 9)
                        ->where('created_by_user_id', $consultancy->id)
                        ->where('status', 'Active')
                        ->orderBy('id', 'desc')
                        ->get();
                    $bom = DB::table('users')
                        ->where('id', $consultancy->created_by_user_id)
                        ->where('role_id', 6)
                        ->where('status', 'Active')
                        ->orderBy('id', 'desc')
                        ->first();
                    if ($bom) {
                        $consultancies = $consultancies->prepend($bom);
                    }
                }
                break;
            case 11: 
                $consultants = DB::table('users')
                    ->leftJoin('consultants', 'consultants.user_id', '=', 'users.id')
                    ->where('users.id', $userId)
                    ->where('users.status', 'Active')
                    ->select('users.*', 'consultants.joining_date', 'consultants.designation', 'consultants.emp_code', 'consultants.profile_image')
                    ->orderBy('users.id', 'desc')
                    ->get();
                $hr = DB::table('users')
                    ->where('id', $baseUser->created_by_user_id)
                    ->where('role_id', 8)
                    ->where('status', 'Active')
                    ->orderBy('id', 'desc')
                    ->first();
                if ($hr) {
                    $hrs = collect([$hr]);
                    $consultancy = DB::table('users')
                        ->where('id', $hr->created_by_user_id)
                        ->where('role_id', 7)
                        ->where('status', 'Active')
                        ->orderBy('id', 'desc')
                        ->first();
                    if ($consultancy) {
                        $consultancies = collect([$consultancy]);
                        $clients = DB::table('users')
                            ->where('role_id', 9)
                            ->where('created_by_user_id', $consultancy->id)
                            ->where('status', 'Active')
                            ->orderBy('id', 'desc')
                            ->get();
                        $bom = DB::table('users')
                            ->where('id', $consultancy->created_by_user_id)
                            ->where('role_id', 6)
                            ->where('status', 'Active')
                            ->orderBy('id', 'desc')
                            ->first();
                        if ($bom) {
                            $consultancies = $consultancies->prepend($bom);
                        }
                    }
                }
                break;
        }
        return [
            'consultancies' => $consultancies,
            'clients' => $clients,
            'hrs' => $hrs,
            'consultants' => $consultants
        ];
    }
    public function getUserHierarchyData($user) {
        $roleId = $user->role_id;
        $userId = $user->id;
        $consultancies = collect();
        $hrs = collect();
        $clients = collect();
        $consultants = collect();
        if ($roleId == 6) {
            $consultancies = DB::table('users')
                ->where('role_id', 7)
                ->where('created_by_user_id', $userId)
                ->where('status', 'Active')
                ->get();
            $hrIds = [];
            foreach ($consultancies as $consultancy) {
                $hrsInThis = DB::table('users')
                    ->where('role_id', 8)
                    ->where('created_by_user_id', $consultancy->id)
                    ->where('status', 'Active')
                    ->get();
                $hrs = $hrs->merge($hrsInThis);
                $hrIds = array_merge($hrIds, $hrsInThis->pluck('id')->toArray());
            }
            $consultancyIds = $consultancies->pluck('id')->toArray();
            $clients = DB::table('clients')
                ->whereIn('user_id', $consultancyIds)
                ->get();
            if (!empty($hrIds)) {
                $consultants = DB::table('consultants')
                    ->whereIn('user_id', $hrIds)
                    ->where('status', 'Active')
                    ->get();
            }
        }
        elseif ($roleId == 7) {
            $hrs = DB::table('users')
                ->where('role_id', 8)
                ->where('created_by_user_id', $userId)
                ->where('status', 'Active')
                ->get();
            $hrIds = $hrs->pluck('id')->toArray();
            $clients = DB::table('clients')
                ->where('user_id', $userId)
                ->get();
            if (!empty($hrIds)) {
                $consultants = DB::table('consultants')
                    ->whereIn('user_id', $hrIds)
                    ->where('status', 'Active')
                    ->get();
            }
            $consultancies = collect([$user]);
        }
        elseif ($roleId == 8) {
            $consultancy = DB::table('users')
                ->where('id', $user->created_by_user_id)
                ->where('role_id', 7)
                ->where('status', 'Active')
                ->first();
            if ($consultancy) {
                $consultancies = collect([$consultancy]);
                $clients = DB::table('clients')
                    ->where('user_id', $consultancy->id)
                    ->get();
            }
            $consultants = DB::table('consultants')
                ->where('user_id', $userId)
                ->where('status', 'Active')
                ->get();
            $hrs = collect([$user]);
        }
        return [
            'consultancies' => $consultancies,
            'hrs' => $hrs,
            'clients' => $clients,
            'consultants' => $consultants,
        ];
    }

  

    public function add_consultant(Request $request)
    {
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
            // 'select_client' => 'nullable|string|max:100',
            'select_holiday' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'login_email' => 'nullable|email|max:100',
            'reset_password' => 'nullable|in:0,1',
            'receipt_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // ✅ Duplicate check for consultant email
        if ($request->email && DB::table('consultants')->where('email', $request->email)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'The entered consultant email already exists. Please use a different one.',
            ]);
        }

        // ✅ Duplicate check for login_email in users table
        if (DB::table('users')->where('email', $request->login_email)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'This user credentials user ID (email) is already registered. Please choose another one.',
            ]);
        }

       
        $data = $request->except(['_token', 'profile_image', 'edit_id']);

        // ✅ handle profile picture file
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('consultants/profile', 'public');
        }

        $consultantId = DB::table('consultants')->insertGetId(
            array_merge($data, ['user_id' => null]) // insert but keep user_id blank
        );
        $user = User::create([
            'name'     => $data['emp_name'],
            'email'    => $data['login_email'],
            'role_id'  => 11,
            'status'   => $data['status'],
            'created_by_user_id' => auth()->id(),
        ]);
        $userinsertedId = $user->id;
        DB::table('consultants')->where('id', $consultantId)->update(['user_id' => $userinsertedId]);

        if($request->reset_password == 1)
        {
            $data = [
                'name' => $request->emp_name,
                'message' => 'Here is the important link you requested.',
                'url' => route('insert.password', ['id' => $userinsertedId]) // You can replace this with any dynamic URL
            ];
    
            Mail::to($request->login_email)->send(new TestMail($data));
        }

        return response()->json([
            'message' => 'Consultant added successfully!',
        ]);
    }

    public function update_consultant(Request $request, $id)
    {
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
            'receipt_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // ✅ Check if consultant exists
        $consultant = DB::table('consultants')->where('id', $id)->first();
        if (!$consultant) {
            return response()->json([
                'status' => false,
                'message' => 'Consultant not found.',
            ], 404);
        }

        // ✅ Prevent updating to an existing email
        if ($request->email && DB::table('consultants')->where('email', $request->email)->where('id', '!=', $id)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'The entered consultant email already exists.',
            ]);
        }

        if ($request->login_email && DB::table('users')->where('email', $request->login_email)->where('id', '!=', $consultant->user_id)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'This user ID (login email) is already registered.',
            ]);
        }

        $data = $request->except(['_token', 'profile_image', 'edit_id', '_method']);

        // ✅ Handle profile picture update
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('consultants/profile', 'public');
        }

        // ✅ Update consultant
        DB::table('consultants')->where('id', $id)->update($data);

        // ✅ Update user info
        if ($consultant->user_id) {
            DB::table('users')
                ->where('id', $consultant->user_id)
                ->update([
                    'name' => $request->emp_name,
                    'email' => $request->login_email,
                    'status' => $request->status,
                ]);
        }

        // ✅ Send reset password email if requested
        if ($request->reset_password == 1 && $consultant->user_id) {
            $data = [
                'name' => $request->emp_name,
                'message' => 'Here is the important link you requested.',
                'url' => route('insert.password', ['id' => $consultant->user_id])
            ];

            Mail::to($request->login_email)->send(new TestMail($data));
        }

        return response()->json([
            'message' => 'Consultant updated successfully!',
        ]);
    }


}