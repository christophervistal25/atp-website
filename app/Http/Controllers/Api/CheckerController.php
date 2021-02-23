<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Checker;
use Illuminate\Support\Facades\Hash;
use App\PersonLog;


class CheckerController extends Controller
{
    public function login(Request $request)
    {
        // Check if checker is exists.
        $checker = Checker::where(['username' => $request->username])->first();
        
        // Checker has record.
        if(!is_null($checker)) {
            // Password verified.
            if(Hash::check($request->password, $checker->password)) {
                // Make password of the checker like 
                $salt = null;
                foreach(str_split($checker->username) as $character) {
                    $salt .= ord($character); 
                }
                $generated_password = md5($request->password) . $salt;
                return response()->json(['code' => 200, 'id' => $checker->id, 'username' => $checker->username , 'password' => $generated_password, 'firstname' => $checker->firstname, 'middlename' => $checker->middlename, 'lastname' => $checker->lastname, 'suffix' => $checker->suffix]);
            } else { // Wrong credentials
                return response()->json(['code' => 422, 'message' => 'Invalid username / password.']);
            }
        } else {
            return response()->json(['code' => 422, 'message' => 'Invalid username / password.']);
        }
    }
    
    public function countQRScanned(int $id)
    {
        $scanned = PersonLog::where('checker_id', $id)
                        ->count();
        return response()->json(['code' => 200, 'scanned_count' => $scanned]);
    }
}
