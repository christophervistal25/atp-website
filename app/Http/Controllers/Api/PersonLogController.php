<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\PersonnelRepository;
use App\PersonLog;
use App\Person;
use App\Barangay;
use Carbon\Carbon;
use DB;
use Exception;

class PersonLogController extends Controller
{

    public function __construct(PersonnelRepository $personnelRepo)
    {
        $this->personnelRepository = $personnelRepo;
    }

    public function scanned(Request $request)
    {
        // Check if user is registered from mobile or website.
        if(strtoupper($request->registered_from) === 'MOBILE') {
            // Process for insertion of the user.
            // Add the user first in the database.
            DB::beginTransaction();
            try {
                $barangay = Barangay::where(['name' => $request->barangay])->first();
                $person = Person::firstOrCreate(
                    [
                        'firstname'     => strtoupper($request->firstname),
                        'middlename'    => strtoupper($request->middlename),
                        'lastname'      => strtoupper($request->lastname),
                        'suffix'        => strtoupper($request->suffix),
                        'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d'),
                    ]
                    ,[
                    'firstname'         => $request->firstname,
                    'middlename'        => $request->middlename,
                    'lastname'          => $request->lastname,
                    'suffix'            => $request->suffix,
                    'temporary_address' => '',
                    'address'           => $request->purok . ' ' . $request->street . ' ' . $request->barangay . ' ' . $request->municipality . ' ' . $request->province,
                    'date_of_birth'     => Carbon::parse($request->date_of_birth)->format('Y-m-d'),
                    'image'             => 'default.png',
                    'gender'            => $request->gender,
                    'province_code'     => $barangay->province_code,
                    'city_code'         => $barangay->city_code,
                    'barangay_code'     => $barangay->code,
                    'civil_status'      => $request->civil_status,
                    'phone_number'      => $request->phone_number,
                    'landline_number'   => $request->landline_number,
                    'age'               => $this->personnelRepository->getAge($request->date_of_birth),
                    'registered_from' => $request->registered_from
                ]);

                PersonLog::create([
                    'person_id'        => $person->id,
                    'location'         => $request->location,
                    'checker_id'       => $request->checker_id,
                    'purpose'          => $request->purpose,
                    'body_temperature' => $request->temperature,
                    'time'             => $request->time,
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        } else {
            PersonLog::create([
                'person_id'        => $request->user_id,
                'location'         => $request->location,
                'checker_id'       => $request->checker_id,
                'purpose'          => $request->purpose,
                'body_temperature' => $request->temperature,
                'time'             => $request->time,
            ]);
        }


        return response()->json(['code' => 200, 'message' => 'success']);
    }

    public function addMultiple(Request $request)
    {
        $records = json_decode($request->data, true);
        foreach($records as $log) {
            if(strtoupper($log['registered_from']) === 'MOBILE') {
                try {
                    $barangay = Barangay::where(['name' => $log['barangay']])->first();
                    $birthdate = Carbon::parse($log['date_of_birth'])->format('Y-m-d');
                    $person = Person::firstOrCreate(
                        [
                            'firstname'     => strtoupper($log['firstname']),
                            'middlename'    => strtoupper($log['middlename']),
                            'lastname'      => strtoupper($log['lastname']),
                            'suffix'        => strtoupper($log['suffix']),
                            'date_of_birth' => $birthdate,
                        ]
                        ,[
                        'firstname'         => $log['firstname'],
                        'middlename'        => $log['middlename'],
                        'lastname'          => $log['lastname'],
                        'suffix'            => $log['suffix'],
                        'temporary_address' => '',
                        'address'           => $log['address'],
                        'date_of_birth'     => $birthdate,
                        'image'             => 'default.png',
                        'gender'            => $log['gender'],
                        'province_code'     => $barangay['province_code'],
                        'city_code'         => $barangay['city_code'],
                        'barangay_code'     => $barangay['code'],
                        'civil_status'      => $log['civil_status'],
                        'phone_number'      => $log['mobile_number'],
                        'landline_number'   => $log['landline_number'],
                        'age'               => $this->personnelRepository->getAge($log['date_of_birth']),
                    ]);

                    PersonLog::create([
                        'person_id'        => $person->id,
                        'location'         => $log['location'],
                        'checker_id'       => $log['checker_id'],
                        'purpose'          => $log['purpose'],
                        'body_temperature' => $log['body_temperature'],
                        'time'             => $log['time'],
                    ]);

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                }
            } else {
                $person = Person::find($log['person_id']);
                PersonLog::create([
                    'person_id'        => $person->id,
                    'location'         => $log['location'],
                    'checker_id'       => $log['checker_id'],
                    'purpose'          => $log['purpose'],
                    'body_temperature' => $log['body_temperature'],
                    'time'             => $log['time'],
                ]);
            }

        }

        return response()->json(
            [
                'code' => 200, 'message' => 'Successfully add all the records.'
            ]
        );
    }
}
