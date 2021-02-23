<?php

namespace App\Http\Controllers\Municipal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Person;
use App\Barangay;
use Illuminate\Support\Str;
use Freshbitsweb\Laratables\Laratables;
use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Repositories\PersonnelRepository;

class PersonnelController extends Controller
{

    public const QR_SEPERATOR = ',';

    public function __construct(PersonnelRepository $personnelRepository)
    {
        $this->personnelRepository = $personnelRepository;
        $this->middleware('auth:municipal');
    }

    public function list()
    {
        $city_code = Auth::user()->city_code;

        return Laratables::recordsOf(Person::class, function ($query) use($city_code) {
            return $query->where('city_code', $city_code);
        });
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
            'firstname'         => 'required',
            'middlename'        => 'required',
            'lastname'          => 'required',
            'date_of_birth'     => 'required|date',
            'gender'            => 'required|in:' . implode(',', PersonnelRepository::GENDER),
            'temporary_address' => 'required',
            'phone_number'      => 'required|unique:people,phone_number',
            'address'           => 'required',
            'status'            => 'required',
            'barangay'          => 'required|exists:barangays,code',
            'image'             => 'required',
        ]);

        if($request->has('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            // Process of storing image.
            $request->file('image')->storeAs('/public/images', $imageName);
        }

        // Province Code
        $barangay = Barangay::where('code', $request->barangay)->first();

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
            'province_code'     => $barangay->province_code,
            'city_code'         => $barangay->city_code,
            'barangay_code'     => $barangay->code,
            'civil_status'      => $request->status,
            'phone_number'      => $request->phone_number,
            'landline_number'   => $request->landline_number,
            'age'               => $this->personnelRepository->getAge($request->date_of_birth),
        ]);


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
        $barangays = Auth::user()->city->barangays;
        $person = Person::find($id);
        return view('municipal.personnel.edit', compact('person', 'barangays'));
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
