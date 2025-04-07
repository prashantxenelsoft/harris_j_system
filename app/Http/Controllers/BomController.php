<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultancy;
use Illuminate\Support\Facades\Auth;
use DB;

class BomController extends Controller
{
    public function dashboard()
    {
        $consultancies = Consultancy::orderBy('id', 'desc')->get();
        $user = Auth::user();
        $menus = DB::table('role_permissions')
        ->join('menus', 'role_permissions.menu_id', '=', 'menus.id')
        ->where('role_permissions.role_id', $user->role_id)
        ->where('menus.status', 1) 
        ->select('menus.*')
        ->get();

        $bom_static_settings = DB::table('bom_static_settings')
        ->whereNull('lookup_option')
        ->orderBy('id', 'desc')
        ->get();
        $bom_static_settings_header_option = DB::table('bom_static_settings')
        ->whereNull('lookup_header')
        ->orderBy('id', 'desc')
        ->get();
       // echo "<pre>";print_r($consultancies);die;
        return view('bom.dashboard', compact('user', 'menus','consultancies','bom_static_settings','bom_static_settings_header_option'));
    }

}
