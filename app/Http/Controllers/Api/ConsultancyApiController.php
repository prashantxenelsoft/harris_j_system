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

}
