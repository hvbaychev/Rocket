<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Technology;
use App\Models\University;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileManager extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function profilePost(ProfileRequest $request)
    {
        $user = User::where('email', '=', $request->email)->first();

        $user->update($request->all());
        if ($user) {
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->back()->with('fail', 'Try again');
        }
    }


}
