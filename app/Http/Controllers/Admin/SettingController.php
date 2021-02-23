<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Barangay;
use App\Municipal;
use App\City;
use App\Province;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $admins    = Admin::get();


        $municipals_account = Municipal::with('city')->get();

        $provinces = Province::get();
        // return view('admin.setting.index', compact('admins', 'barangays', 'cities', 'municipals_account'));
        return view('admin.setting.index', compact('admins', 'provinces', 'municipals_account'));
    }

    public function addMunicipal(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'code'     => 'required|unique:cities',
            'province' => 'required|exists:provinces,code',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            // Common validation passed
            $hasTheSameData = City::where(['name' => $request->name, 'code' => $request->code, 'province_code' => $request->province])
                    ->count();

            if($hasTheSameData) {
                $validator->getMessageBag()->add('name', 'This municipality already exists.');
                return back()->withErrors($validator);
            }
        }


        City::create([
            'name'          => $request->name,
            'province_code' => $request->province,
            'code'          => $request->code,
        ]);


        return back()->with('success', 'Successfully add new municipal.');
    }

    public function updateMunicipal(Request $request)
    {
        if($request->ajax()) {
            $this->validate($request, [
                'name'    => ['required', Rule::unique('cities')->ignore($request->zip_code, 'zip_code')],
            ]);

            $city = City::find($request->zip_code);
            $city->name = $request->name;
            $city->save();

            return response()->json(['success' => true ]);
        }

    }

    public function removeMunicipal(Request $request)
    {
        $this->validate($request, [
            'zip_code' => 'required',
        ]);

        $city = City::find($request->zip_code);
        $city->status = 'in-active';
        $city->save();
        return response()->json(['success' => true]);
    }

    public function addMunicipalAccount(Request $request)
    {
        
        $validator = \Validator::make($request->all(), [
            'username'     => 'required|unique:municipals',
            'password'     => 'required|min:6|max:20|confirmed',
            'phone_number' => 'required|unique:municipals',
            'city'         => 'required|exists:cities,code'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Municipal::create([
            'username'     => $request->username,
            'phone_number' => $request->phone_number,
            'password'     => bcrypt($request->password),
            'city_code'    => $request->city,
        ]);

        return back()->with('success-municipal-account', 'Successfully create new account.');
    }

    public function updateMunicipalAccount(Request $request)
    {
        if($request->ajax()) {
            $this->validate($request, [
                'id' => 'required|exists:municipals,id',
                'place' => 'sometimes|required|exists:cities,zip_code',
                'username' => 'required|unique:municipals,username,' . $request->id,
                'password' => 'required',
            ]);
        }

        $municipal = Municipal::find($request->id);
        $municipal->username = $request->username;


        if(!$this->isUserDontChangePassword($request->password)) {
            $municipal->password = bcrypt($request->password);
        }

        if($request->has('place')) {
            $municipal->city_zip_code = $request->place;
        }

        $municipal->save();

        return response()->json(['success' => true, 'place' => $municipal->city->name]);
    }

    private function isUserDontChangePassword(string $password)
    {
        $length         = strlen($password);
        $password_array = str_split($password);
        $countAsterisk  = 0;

        foreach($password_array as $p) {
            if($p === '*') {
                $countAsterisk++;
            }
        }
        return $length === $countAsterisk;
    }

    public function adminAccountUpdate(Request $request)
    {
        if($request->ajax()) {

            $this->validate($request, [
                'username' => 'required|unique:admins,username,' . $request->account_id,
                'password' => 'required',
            ]);




            // Update the account
            $admin           = Admin::find($request->account_id);
            $admin->username = $request->username;
            if(!$this->isUserDontChangePassword($request->password)) {
                $admin->password = bcrypt($request->password);
            }
            $admin->save();

            return response()->json(['success' => true]);
        }
    }
}
