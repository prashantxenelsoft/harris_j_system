<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Consultancy;

class ConsultancyApiController extends Controller
{
    public function getConsultancy(Request $request)
    {
        $consultancies = Consultancy::orderBy('id', 'desc')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Consultancies fetched successfully',
            'data' => $consultancies
        ], 200);
    }
}
