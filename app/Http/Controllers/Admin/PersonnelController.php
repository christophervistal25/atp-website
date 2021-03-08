<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Person;
use Illuminate\Support\Str;
use App\Http\Controllers\Repositories\PersonnelRepository;
use Freshbitsweb\Laratables\Laratables;
use App\City;
use App\Barangay;
use App\Province;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Cache;
use DB;

class PersonnelController extends Controller
{

    public const QR_SEPERATOR = ',';

    public function __construct(PersonnelRepository $personnelRepo)
    {
        $this->personnelRepository = $personnelRepo;
    }

    public function list(string $filter)
    {
        if($filter !== 'all') {
            return Laratables::recordsOf(Person::class, function($query) use ($filter) {
                return $query->where('province_code', $filter);
            });
        } else {
            return Laratables::recordsOf(Person::class);
        }


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::orderBy('name')
                            ->get(['code', 'name']);
        return view('admin.personnel.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $provinces =  Province::get(['code', 'name']);
        $civil_status = PersonnelRepository::CIVIL_STATUS;

        return view('admin.personnel.create', compact('civil_status', 'provinces'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'username'          => 'required|unique:users,username',
            'password'          => 'required|min:8|max:20',
            'mpin'              => 'required|max:4|same:mpin_confirmation',
            'password'          => 'required|min:8|max:20|confirmed',
            'firstname'         => 'required|regex:/^[A-Za-z ]+$/u',
            'middlename'        => 'required|regex:/^[A-Za-z ]+$/u',
            'lastname'          => 'required|regex:/^[A-Za-z ]+$/u',
            'date_of_birth'     => 'required|date',
            'gender'            => 'required|in:' . implode(',', PersonnelRepository::GENDER),
            'temporary_address' => 'required',
            'address'           => 'required',
            'city'              => 'required|exists:cities,code',
            'barangay'          => 'required|exists:barangays,code',
            'province'          => 'required|exists:provinces,code',
            'image'             => 'required',
            'status'            => 'required|in:' . implode(',', PersonnelRepository::CIVIL_STATUS),
            'phone_number'      => 'required|unique:people',
        ],[
            'image.required' => 'Please attach some image.',
        ]);

        if($request->has('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            // Process of storing image.
            $request->file('image')->storeAs('/public/images', $imageName);
        }


        DB::beginTransaction();

        try {
            $person = Person::create([
                'firstname'         => $request->firstname,
                'middlename'        => $request->middlename,
                'lastname'          => $request->lastname,
                'temporary_address' => $request->temporary_address,
                'address'           => $request->address,
                'suffix'            => $request->suffix,
                'date_of_birth'     => Carbon::parse($request->date_of_birth)->format('Y-m-d'),
                'image'             => $imageName ?? 'default.png',
                'gender'            => $request->gender,
                'province_code'     => $request->province,
                'city_code'         => $request->city,
                'barangay_code'     => $request->barangay,
                'civil_status'      => $request->status,
                'phone_number'      => $request->phone_number,
                'landline_number'   => $request->landline_number,
                'age'               => $this->personnelRepository->getAge($request->date_of_birth),
            ]);


            User::create([
                'username'  => $request->username,
                'password'  => bcrypt($request->password),
                'person_id' => $person->id,
                'mpin'      => bcrypt($request->mpin)
            ]);

            DB::commit();
            return back()->with('success', $person->id);
        } catch(\Exception $e) {
            abort(404);
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $personnel)
    {

        $provinces = Province::get();

        $civil_status = PersonnelRepository::CIVIL_STATUS;

        return view('admin.personnel.edit', compact('personnel', 'provinces', 'civil_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username'          => 'required|unique:users,username,' . $id,
            'firstname'         => 'required|regex:/^[A-Za-z ]+$/u',
            'middlename'        => 'required|regex:/^[A-Za-z ]+$/u',
            'lastname'          => 'required|regex:/^[A-Za-z ]+$/u',
            'date_of_birth'     => 'required|date',
            'gender'            => 'required|in:' . implode(',', PersonnelRepository::GENDER),
            'temporary_address' => 'required',
            'address'           => 'required',
            'city'              => 'required|exists:cities,code',
            'barangay'          => 'required|exists:barangays,code',
            'province'          => 'required|exists:provinces,code',
            'status'            => 'required|in:' . implode(',', PersonnelRepository::CIVIL_STATUS),
            'phone_number'      => 'required|unique:people,phone_number,' . $id,
        ],['image.required' => 'Please attach some image.']);

        if($request->has('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            // Process of storing image.
            $request->file('image')->storeAs('/public/images', $imageName);
        }

        DB::beginTransaction();

        try {
            $person = Person::with('account')->find($id);

            $person->firstname         = $request->firstname;
            $person->middlename        = $request->middlename;
            $person->lastname          = $request->lastname;
            $person->temporary_address = $request->temporary_address;
            $person->address           = $request->address;
            $person->suffix            = $request->suffix;
            $person->date_of_birth     = Carbon::parse($request->date_of_birth)->format('Y-m-d');
            $person->image             = $imageName ?? $person->image;
            $person->gender            = $request->gender;
            $person->province_code     = $request->province;
            $person->city_code         = $request->city;
            $person->barangay_code     = $request->barangay;
            $person->civil_status      = $request->status;
            $person->phone_number      = $request->phone_number;
            $person->landline_number   = $request->landline_number;
            $person->age               = $this->personnelRepository->getAge($request->date_of_birth);

            $account = $person->account;

            if(!is_null($request->username)) {
                $account->username = $request->username;
            }

            if(!is_null($request->password)) {
                $account->password = bcrypt($request->password);
            }

            if(!is_null($request->mpin)) {
                $account->mpin = bcrypt($request->mpin);
            }

            $account->save();
            $account->info()->save($person);

            DB::commit();

            return back()->with('success', $person->id);
        } catch(\Exception $e) {
            dd($e->getMessage());
            abort(404);
            DB::rollback();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
