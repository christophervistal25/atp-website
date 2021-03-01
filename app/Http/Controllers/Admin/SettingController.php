<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::get();
        return view('admin.setting.index', compact('settings'));
    }
}
