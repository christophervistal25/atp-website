<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;
use App\Barangay;
use Illuminate\Support\Facades\Cache;

class ProvinceController extends Controller
{
    public const SECONDS_IN_ONE_DAY = 86400;

    public function municipals(string $province_code)
    {
        Cache::flush();
        $municipals = Cache::remember('municipals_' . $province_code, self::SECONDS_IN_ONE_DAY, function () use ($province_code) {
            return City::where('province_code', $province_code)
            ->where('status', 'active')
            ->get(['code', 'name']);
        });

        return response()->json(['municipals' => $municipals]);
    }

    public function barangays(string $city_code)
    {
        Cache::flush();
        $barangays = Cache::remember('barangays' . $city_code, self::SECONDS_IN_ONE_DAY, function () use($city_code) {
            return Barangay::where('city_code', $city_code)
                ->get(['code', 'name']);
        });

        return response()->json(['barangays' => $barangays]);
    }
}
