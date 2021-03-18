<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Person;
use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Repositories\PersonnelRepository;
use App\Rules\UniqueUser;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PersonnelRepository $personnelRepository)
    {
        $this->personnelRepository = $personnelRepository;
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname'     => ['required', 'string', 'max:255'],
            'lastname'      => ['required', 'string', 'max:255'],
            'middlename'    => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'phone_number'  => ['required', 'string', 'max:255', 'unique:people,phone_number'],
            'username'      => ['required', 'string', 'max:255', 'unique:users', new UniqueUser()],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        try {

            $person = Person::create([
                'firstname'         => $data['firstname'],
                'middlename'        => $data['middlename'],
                'lastname'          => $data['lastname'],
                'date_of_birth'     => Carbon::parse($data['date_of_birth'])->format('Y-m-d'),
                'phone_number'      => $data['phone_number'],
                'province_code'     => '*',
                'city_code'         => '*',
                'barangay_code'     => '*',
                'temporary_address' => '*',
                'address'           => '*',
                'age'               => $this->personnelRepository->getAge($data['date_of_birth']),
                'civil_status'      => '*',
            ]);


            $user = User::create([
                'username'  => $data['username'],
                'password'  => Hash::make($data['password']),
                'person_id' => $person->id,
                'mpin'      => '*',
            ]);

            DB::commit();
            return $user;
        } catch(\Exception $e) {
            DB::rollback();
        }

    }
}
