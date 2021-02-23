<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\City;
use App\PersonLog;
use App\Municipal;
use App\Admin;
use App\Person;
use App\Checker;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin',['only' => 'index','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities      = City::where('status', 'active')->orderBy('code')->get('name')->pluck('name')->toArray();
        $citiesValue = City::where('status', 'active')->withCount('people')->get('people_count')->pluck('people_count')->toArray();

        $cities      = implode(',', $cities);
        $citiesValue = implode(',', $citiesValue);

        $normal = PersonLog::where('body_temperature', '<=', 37)->count();
        $notNormal = PersonLog::where('body_temperature', '>=', 38)->count();

        // No of registered. Admins
        $admins = Admin::count();
        // No of municipals account
        $municipals_account = Municipal::count();

        // No of Registered Municipal Account
        $noOfCities = City::where('status', 'active')->count();

        // No of checkers
        $checkers = Checker::count();

        // No of People Registered
        $peoples = Person::count();

        return view('admin.dashboard', compact('cities', 'citiesValue', 'normal', 'notNormal', 'admins', 'municipals_account', 'noOfCities', 'peoples', 'checkers'));
        // return view('admin.dashboard', compact('peoples', 'checkers', 'admins', 'municipals_account', 'noOfCities'));
    }

}
