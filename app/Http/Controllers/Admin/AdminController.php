<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('user_data')) {
            $userData = Session::get('user_data');
            $roleId = $userData['role_id'];
            if ($roleId == 12) {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($roleId == 6) {
                return redirect()->intended(route('bom.dashboard'));
            }  elseif ($roleId == 11) {
                return redirect()->intended(route('consultant.dashboard'));
            } else {
                Auth::logout();
                return back()->with('error', 'Unauthorized access');
            }
        
        } else {
            return view('admin.login');
        }
       
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Session::put('user_data', [
                'id' => $user->id,
                'email' => $user->email,
                'role_id' => $user->role_id,
            ]);

            // Redirect based on role_id
            if ($user->role_id == 12) {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role_id == 6) {
                return redirect()->intended(route('bom.dashboard'));
            }  elseif ($user->role_id == 11) {
                return redirect()->intended(route('consultant.dashboard'));
            } else {
                Auth::logout();
                return back()->with('error', 'Unauthorized access');
            }
        }

        return back()->with('error', 'Invalid credentials');
    }


    public function dashboard()
    {
        $userData = Session::get('user_data');
        if($userData['role_id'] == 12)
        {
            return view('admin.dashboard');
        }
        else
        {
            return view('errors.404');
        }
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush(); 
        $request->session()->invalidate(); // Session ko invalidate karo
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
