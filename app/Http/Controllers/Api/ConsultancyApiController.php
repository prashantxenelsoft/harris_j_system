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

        $countryMap = [
            'Austria' => 'at',
            'Afghanistan' => 'af',
            // Add more countries as needed
        ];

        $formatted = $consultancies->map(function ($item) use ($countryMap) {
            $country = null;
            $flag = null;

            if (preg_match('/country:\s*([^,]+)/', $item->full_address, $matches)) {
                $country = trim($matches[1]);

                $code = $countryMap[$country] ?? null;

                if ($code) {
                    $flag = "https://flagcdn.com/w80/{$code}.png"; // 80px width flag
                }
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
