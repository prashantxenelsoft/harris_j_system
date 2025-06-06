<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function apiLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to generate JWT token using provided credentials
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = Auth::user();

        $data = [
            'id' => $user->id,
            'email' => $user->email,
            'role_id' => $user->role_id,
        ];

        $roleRedirects = [
            12 => ['route' => 'admin.dashboard', 'dashboard_name' => 'Admin Dashboard'],
            6  => ['route' => 'bom.dashboard', 'dashboard_name' => 'BOM Dashboard'],
            7  => ['route' => 'consultancy.dashboard', 'dashboard_name' => 'Consultancy Dashboard'],
            11 => ['route' => 'consultant.dashboard', 'dashboard_name' => 'Consultant Dashboard'],
            8 => ['route' => 'consultant.dashboard', 'dashboard_name' => 'HR Dashboard'],
        ];

        if (!array_key_exists($user->role_id, $roleRedirects)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access',
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'redirect_to' => route($roleRedirects[$user->role_id]['route']),
            'dashboard_name' => $roleRedirects[$user->role_id]['dashboard_name'],
            'user' => $data,
        ]);
    }
}
