<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\AuthRequest;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{




    public function registration(){
        return view('register');
    }

    public function registerUser(AuthRequest $request){
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $res = $user->save();

        if ($res){
            return back()->with('success', 'You have registered successfully');
        }else{
            return back()->with('fail', 'Something wrong');
        }
    }




    public function login(){
        return view('login');
    }

    public function loginUser(AuthRequest $request){
        $user = User::where('email','=',$request->email)->first();
        if ($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                return redirect('profile');
            }else{
                return back()->with('fail', 'Password not matches.');
            }
        }else{
            return back()->with('fail', 'This email is not registered.');
        }
    }



    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
        }

        return redirect('login');
    }
}
