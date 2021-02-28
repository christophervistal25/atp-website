<?php

namespace App\Http\Controllers\Repositories;
use App\Person;
use App\Barangay;
use App\City;
use App\Province;
use App\Http\Controllers\Repositories\Encrytor;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PersonnelRepository
{
    public const QR_SEPERATOR = '|';
    public const ID_SEPERATOR = '-';
    public const GENDER = ['Male', 'Female'];
    public const CIVIL_STATUS = ['Single', 'Single Parent', 'Married', 'Separated', 'Widow', 'Widowed', 'Annuled'];

    public static function generateQRbyData(Person $person)
    {
        $person->suffix = $person->suffix ?? '*';
        $person->landline_number = $person->landline_number ?? '*';
        $person->email = $person->email ?? '*';

        $user_information =   $person->id . self::QR_SEPERATOR
                    . $person->firstname . self::QR_SEPERATOR
                    . $person->middlename .  self::QR_SEPERATOR
                    . $person->lastname . self::QR_SEPERATOR
                    . $person->suffix . self::QR_SEPERATOR
                    . $person->age . self::QR_SEPERATOR
                    . $person->civil_status . self::QR_SEPERATOR
                    . $person->phone_number . self::QR_SEPERATOR
                    . $person->email . self::QR_SEPERATOR
                    . $person->province->name . self::QR_SEPERATOR
                    . $person->city->name . self::QR_SEPERATOR
                    . $person->barangay->name . self::QR_SEPERATOR
                    . $person->date_of_birth . self::QR_SEPERATOR
                    . $person->landline_number . self::QR_SEPERATOR
                    . ucfirst($person->gender) . self::QR_SEPERATOR
                    . $person->person_id . self::QR_SEPERATOR
                    . $person->address . self::QR_SEPERATOR
                    . $person->registered_from;


        return Encryptor::process($user_information);
    }

    public function isUnique(array $data) :bool
    {
        $birthdate = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
        
        $person = Person::where(
            [
                'firstname'         => strtoupper($data['firstname']),
                'middlename'        => strtoupper($data['middlename']),
                'lastname'          => strtoupper($data['lastname']),
                'suffix'            => strtoupper($data['suffix']),
                'date_of_birth'     => $birthdate,
            ]
        )->exists();
        
        return $person;
    }

    public function temporaryStore(array $data = []) :Person
    {
        $birthdate = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
        $barangay = Barangay::find($data['barangay']);

        $person = Person::create(
            [
            'firstname'         => $data['firstname'],
            'middlename'        => $data['middlename'],
            'lastname'          => $data['lastname'],
            'suffix'            => $data['suffix'],
            'temporary_address' => '*',
            'address'           => '*',
            'date_of_birth'     => $birthdate,
            'image'             => 'default.png',
            'province_code'     => $barangay->province_code,
            'city_code'         => $barangay->city_code,
            'barangay_code'     => $barangay->code,
            'civil_status'      => '*',
            'phone_number'      => $data['phone_number'],
            'landline_number'   => '*',
            'age'               => $this->getAge($birthdate),
            'registered_from'   => 'MOBILE'
        ]);

        return $person;
    }

    private static function counterForPerson(array $data = [])
    {
        return Person::count();
    }

    private static function makeCounter($lastRegisteredPerson) :string
    {
        // No registered person
        if(is_null($lastRegisteredPerson)) {
            $counter = 1;
        } else {
            $counter = ($lastRegisteredPerson + 1);
        }

        $counter = str_pad($counter, 7, 0, STR_PAD_LEFT);
        return $counter;
    }

    private static function makeID(Person $person,  $personCounter) :string
    {

        return $personCounter;
    }

    public static function generateID(Person $person) :string
    {
            $lastRegisteredPerson = self::counterForPerson();

            $personCounter = self::makeCounter($lastRegisteredPerson);
            return self::makeID($person, $personCounter);

    }


    public function makeIDForMobile(array $data = []):string
    {
        $person = $this->temporaryStore($data);
        return $person->person_id;
    }


    public function getAge(string $birthdate) :int
    {
        $birthDateYear = Carbon::parse($birthdate)->year;
        $currentYear   = Carbon::now()->year;

        return $currentYear - $birthDateYear;
    }
}

