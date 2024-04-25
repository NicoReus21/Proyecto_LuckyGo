<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //
    public function register(Request $request){

    }

    public function login(Request $request){

        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
            //"active" => true
        ];

        $remember = ($request->has('remember') ? true : false);

        if(Auth::attempt($credentials,$remember)){

            $request->session()->regenerate();

            return redirect()->intended(route('register'));
            
        }else{
            return redirect('login');
        }

    }
}
