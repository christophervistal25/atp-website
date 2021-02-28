<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\PersonnelRepository;
use App\Barangay;
use App\Person;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PersonnelController extends Controller
{
    public function __construct(PersonnelRepository $personnelRepository)
    {
        $this->personnelRepository = $personnelRepository;
    }

    public function show(int $id) :Person
    {
        $columns = [
            'id','barangay_code', 'city_code', 'email', 'landline_number',
            'date_of_birth', 'age', 'civil_status','gender',
            'temporary_address', 'address'
        ];

        return Person::with(['city:code,name', 'barangay:code,name'])
                        ->find($id, $columns);
    }

    public function make(Request $request)
    {
        $isExists = $this->personnelRepository->isUnique($request->all());
        
        if($isExists) {
            return response()->json(['code' => 422, 'message' => 'This user is already exists.']);
        }

        $personId = $this->personnelRepository->makeIDForMobile($request->all());
        return response()->json(
            [
                'code' => 200,
                'message' => 'Successfully generate id for person.',
                'person_id' => $personId,
            ]
        );
    }

}
