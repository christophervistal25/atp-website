<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Barangay;

class BarangayController extends Controller
{
    public function barangay()
    {
        if(Cache::has('barangay')) {
            return Cache::get('barangay');
        } else {
            return Cache::rememberForever('barangay', function () {
                return Barangay::get(['code', 'name']);
            });
        }
    }
}
