<?php

namespace App\Http\Controllers\Municipal;

use DB;
use Auth;
use App\User;
use App\Person;
use App\Barangay;
use Carbon\Carbon;
use App\Rules\UniqueUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use App\Http\Controllers\Repositories\PersonnelRepository;

class PersonnelController extends Controller
{

    public const QR_SEPERATOR = ',';

    public function __construct(PersonnelRepository $personnelRepository)
    {
        $this->personnelRepository = $personnelRepository;
        $this->middleware('auth:municipal');
    }

    public function list(string $filter)
    {
        if($filter !== 'all') {
            return Laratables::recordsOf(Person::class, function ($query) use($filter) {
                return $query->where('barangay_code', $filter);
            });
        } else {
            $city_code = Auth::user()->city_code;
            return Laratables::recordsOf(Person::class, function ($query) use($city_code) {
                return $query->where('city_code', $city_code);
            });
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangays = Auth::user()->city->barangays;
        return view('municipal.personnel.index', compact('barangays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barangays = Auth::user()->barangays;
        $civil_status = PersonnelRepository::CIVIL_STATUS;

        return view('municipal.personnel.create', compact('barangays', 'civil_status'));
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
            'username'          => ['required', 'unique:users,username', new UniqueUser()],
            'password'          => 'required|min:8|max:20',
            'mpin'              => 'required|max:4',
            'firstname'         => ['required', 'regex:/^[A-Za-z ]+$/u', new UniqueUser()],
            'middlename'        => ['required', 'regex:/^[A-Za-z ]+$/u', new UniqueUser()],
            'lastname'          => ['required', 'regex:/^[A-Za-z ]+$/u', new UniqueUser()],
            'date_of_birth'     => 'required|date',
            'gender'            => 'required|in:' . implode(',', PersonnelRepository::GENDER),
            'temporary_address' => 'required',
            'address'           => 'required',
            'barangay'          => 'required|exists:barangays,code',
            'image'             => 'required',
            'status'            => 'required|in:' . implode(',', PersonnelRepository::CIVIL_STATUS),
            'phone_number'      => 'required|unique:people',
        ]);

        // Province Code
        $barangay = Barangay::where('code', $request->barangay)->first();

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
                'image'             => $request->image ?? 'default.png',
                'gender'            => $request->gender,
                'email'             => $request->email,
                'province_code'     => $barangay->province_code,
                'city_code'         => $barangay->city_code,
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
            dd($e->getMessage());
            abort(404);
            DB::rollback();
        }


        return back()->with('success', $person->id);
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
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {}

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
