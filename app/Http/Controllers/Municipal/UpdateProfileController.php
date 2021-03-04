<?php

namespace App\Http\Controllers\Municipal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UpdateProfileController extends Controller
{
    public function edit()
    {
        $account = Auth::user();
        return view('municipal.auth.edit', compact('account'));
    }

    public function update(Request $request)
    {
        $account = Auth::user();

        $this->validate($request, [
            'username'     => 'required|unique:municipals,username,' . $account->id,
            'phone_number' => 'required|unique:municipals,phone_number,' . $account->id,
        ]);

        $account->username = $request->username;
        $account->phone_number = $request->phone_number;
        if(!is_null($account->password)) {
            $account->password = bcrypt($request->password);
        }
        $account->save();

        return back()->with('success', 'Successfully udpate your account information.');

    }
}
