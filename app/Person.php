<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Repositories\PersonnelRepository;
use Carbon\Carbon;

class Person extends Model
{
    protected $fillable = [
        'id',
        'person_id',
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'temporary_address',
        'address',
        'date_of_birth',
        'gender',
        'province_code',
        'city_code',
        'barangay_code',
        'image',
        'age',
        'civil_status',
        'phone_number',
        'landline_number',
        'email',
        'registered_from'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function($person) {
            $person->person_id = PersonnelRepository::generateID($person);
        });

    }



    /**
     * Returns truncated name for the datatables.
     *
     * @param \App\Person
     * @return string
     */
    public static function laratablesCreatedAt($person)
    {
        return $person->created_at->format('M d, Y h:i A');
    }

    public static function laratablesCustomPersonLogs($person)
    {
        return 
        "
        <div class='text-center font-medium'>
            <span class='px-2 py-1 bg-theme-1 rounded text-xs text-white rounded-full'>
                {$person->logs->count()}
            </span>
        </div>
        ";
    }
    
    public static function laratablesGender($person)
    {
        return ucfirst($person->gender);
    }

    /**
     * created_at column should be used for sorting when name column is selected in Datatables.
     *
     * @return string
     */
    public static function laratablesOrderCreatedAt()
    {
        return 'created_at';
    }

    /**
     * Specify row class name for datatables.
     *
     * @param \App\User
     * @return string
     */
    public static function laratablesRowClass($person)
    {
        return "person-{$person->id}";
    }


    /**
     * Returns the image column html for datatables.
     *
     * @param \App\Person
     * @return string
     */
    public static function laratablesCustomImage($person)
    {
        return view('admin.personnel.includes.image', compact('person'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\Person
     * @return string
     */
    public static function laratablesCustomAction($person)
    {
        return view('municipal.personnel.includes.index_action', compact('person'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\Person
     * @return string
     */
    public static function laratablesCustomAdminAction($person)
    {
        return view('admin.personnel.includes.index_action', compact('person'))->render();
    }

    public static function laratablesCustomTrackAction($person)
    {
        return view('admin.track.includes.index_action', compact('person'))->render();
    }

    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    public static function laratablesAdditionalColumns()
    {
        return ['image', 'address', 'province_code', 'city_code', 'barangay_code'];
    }


    public function barangay()
    {
        return $this->belongsTo('App\Barangay', 'barangay_code', 'code');
    }

    public function province()
    {
        return $this->belongsTo('App\Province', 'province_code', 'code');
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_code', 'code');
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['firstname'] = strtoupper($value);
    }

    public function setMiddleNameAttribute($value)
    {
        $this->attributes['middlename'] = strtoupper($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['lastname'] = strtoupper($value);
    }

    public function setSuffixAttribute($value)
    {
        $this->attributes['suffix'] = strtoupper($value);
    }

    public function logs()
    {
        return $this->hasMany('App\PersonLog');
    }

    public function information()
    {
        return $this->belongsTo('App\User', 'id', 'person_id');
    }
}
