<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class RaffleController extends Controller
{
    public function registerForm()
    {
        return view('raffle.register');
    }


    public function play(Request $request){
        $numbers = $request->selected_numbers;
        $array = json_decode($numbers);
        
    }

    public function cancel(){
        
        return redirect()->route('login');
    }
    

}

?>
