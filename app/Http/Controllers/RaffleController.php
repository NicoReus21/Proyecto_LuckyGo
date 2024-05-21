<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RaffleController extends Controller
{
    //
    public function registerForm()
    {
        return view('raffle.register');
    }


}



