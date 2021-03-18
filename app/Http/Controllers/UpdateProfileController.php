<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Province;
use App\Barangay;
use App\Person;
use Carbon\Carbon;
use App\Http\Controllers\Repositories\PersonnelRepository;
use Illuminate\Support\Facades\Cache;
use DB;

class UpdateProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        $provinces = Province::get();

        $residenceOfTandagBarangays = Barangay::where('city_code', '166819000')->get(['name', 'code']);

        $civil_status = PersonnelRepository::CIVIL_STATUS;

        return view('user.update-profile', compact('user', 'provinces', 'civil_status', 'residenceOfTandagBarangays'));
    }

    public function update(Request $request)
    {
        $rules = [];

        $rules = [
            'mpin'              => 'required|max:4',
            'confirm_mpin'      => 'same:mpin',
            'gender'            => 'required|in:' . implode(',', PersonnelRepository::GENDER),
            'temporary_address' => 'required',
            'address'           => 'required',
            'barangay'          => 'required|exists:barangays,code',
            'status'            => 'required|in:' . implode(',', PersonnelRepository::CIVIL_STATUS),
            'photo_of_face'     => 'required',
            'photo_of_id'       => 'required',
        ];

        if($request->has('province') && $request->has('city')) {
            // User select the residence.
            $rules['city']     = 'required|exists:cities,code';
            $rules['province'] = 'required|exists:provinces,code';
        } 

        $this->validate($request, $rules, [
            'photo_of_face.required' => 'Please attach a photo of your face',
            'photo_of_id.required'   => 'Please attach a photo of your I.D'
        ]);
        
        // Upload user photo of face and photo of id.
        $photoOfFaceName = $request->file('photo_of_face')->getClientOriginalName();
        $request->file('photo_of_face')->storeAs('/public/images', $photoOfFaceName);

        $photoOfIdName = $request->file('photo_of_id')->getClientOriginalName();
        $request->file('photo_of_id')->storeAs('/public/photo_id', $photoOfIdName);


        // DB::beginTransaction();
        // try {

        //     $person = Person::find(Auth::user()->person_id);

        //     $person->temporary_address = $request->temporary_address;
        //     $person->address           = $request->address;
        //     $person->image             = $photoOfFaceName ?? $person->image;
        //     $person->photo_of_id       = $photoOfIdName;
        //     $person->gender            = $request->gender;
        //     $person->province_code     = $request->province;
        //     $person->city_code         = $request->city;
        //     $person->barangay_code     = $request->barangay;
        //     $person->civil_status      = $request->status;
        //     $person->email             = $request->email;
        //     $person->landline_number   = $request->landline_number;


        //     $account = $person->account;
        //     $account->mpin = bcrypt($request->mpin);

        //     $account->save();
        //     $account->info()->save($person);

        //     DB::commit();

        //     return redirect()->route('home')->with('success', 'Successfully update your profile.');
        // } catch(\Exception $e) {
        //     abort(404);
        //     DB::rollback();
        // }


    }
}
