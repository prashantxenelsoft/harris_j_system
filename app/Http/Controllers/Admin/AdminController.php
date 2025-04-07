<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

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
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
