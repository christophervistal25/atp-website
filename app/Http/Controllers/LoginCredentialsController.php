<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginCredentialsController extends Controller
{
    public function edit()
    {
        $account = Auth::user();
        return view('user.credentials.update', compact('account'));
    }

    public function update(Request $request)
    {
        $account = Auth::user();

        $rules = [
            'username' => 'required|unique:users,username,' . $account->id,
        ];

        if(!is_null($request->password)) {
            $rules['password'] = 'min:8|max:20|confirmed';
        }

        if(!is_null($request->mpin)) {
            $rules['mpin'] = 'max:4|same:re_type_mpin';
        }

        $this->validate($request, $rules, [], ['mpin' => 'MPIN', 're_type_mpin' => 'MPIN Confirmation']);

        $account->username = $request->username;
        $account->password = !is_null($request->password) ? bcrypt($request->password) : $account->password;
        $account->mpin     = !is_null($request->mpin) ? bcrypt($request->mpin) : $account->mpin;
        $account->save();

        return back()->with('success', 'Successfully update your account credentials.');

    }
}
