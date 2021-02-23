<?php

namespace App\Http\Controllers\Municipal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Barangay;
use App\City;
use App\Checker;
use App\Municipal;
use Auth;

class SettingController extends Controller
{
    
    public function index()
    {
        $municipals    = Municipal::get();

        $barangays = Auth::user()->barangays;

        $municipals_account = Municipal::with('city')->get();

        $checkers = Checker::get();


        return view('municipal.setting.index', compact('municipals', 'barangays',  'municipals_account', 'checkers'));
    }

    public function municipalUpdateAccount(Request $request)
    {
             if($request->ajax()) {

            $this->validate($request, [
                'username' => 'required|unique:municipals,username,' . $request->account_id,
                'password' => 'required',
            ]);

            
          

            // Update the account
            $admin           = MUnicipal::find($request->account_id);
            $admin->username = $request->username;
            if(!$this->isUserDontChangePassword($request->password)) {
                $admin->password = bcrypt($request->password);
            } 
            $admin->save();

            return response()->json(['success' => true]);
        }
    }

    public function addBarangay(Request $request)
    {
            $this->validate($request, [
                'name' => 'required|unique:barangays',
                'code' => 'required|unique:barangays,code',
            ]);

       
            
            $barangay = Barangay::create([
                'name'          => $request->name,
                'code'          => $request->code,
            ]);

            return back()->with('success-barangay', 'Successfully add new barangay.');
    }

    public function updateBarangay(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required|unique:barangays,name,' . $request->id,
            // 'code' => 'required|unique:barangays,code,' . $request->id,
        ]);

        $barangay = Barangay::find($request->id);
        $barangay->name = $request->name;
        // $barangay->code = $request->code;
        $barangay->save();
        return response()->json(['success' => true]);
    }

    public function removeBarangay(Request $request)
    {
        if($request->ajax()) {
            $barangay = Barangay::find($request->id);
            $barangay->status = 'in-active';
            $barangay->save();
            return response()->json(['success' => true]);
        }
    }

    public function addChecker(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required|unique:checkers',
            'firstname'  => 'required',
            'middlename' => 'required',
            'lastname'   => 'required',
            'password'   => 'required|min:6|max:20|confirmed',
        ]);

        Checker::create([
            'username'      => $request->username,
            'firstname'     => $request->firstname,
            'middlename'    => $request->middlename,
            'lastname'      => $request->lastname,
            'password'      => bcrypt($request->password),
            'city_zip_code' => Auth::user()->city_zip_code,
        ]);

        return back()->with('success', 'Successfully add new checker account');
    }

    public function updateChecker(Request $request)
    {
        if($request->ajax()) {
            $this->validate($request, [
                'username' => 'required|unique:checkers,username,' . $request->id,
                'password' => 'required',
            ]);


            $checker             = Checker::find($request->id);
            $checker->username   = $request->username;
            $checker->firstname  = $request->firstname;
            $checker->middlename = $request->middlename;
            $checker->lastname   = $request->lastname;

            if(!$this->isUserDontChangePassword($request->password)) {
                $checker->password = bcrypt($request->password);
            }

            $checker->save();

            return response()->json(['success' => true]);
        }
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
    

}
