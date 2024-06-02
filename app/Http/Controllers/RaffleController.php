<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raffle;

class RaffleController extends Controller
{
    public function registerForm(Request $request)
    {
        $raffle = Raffle::find($request->raffle_id);
        return view('raffle.register', compact('raffle'));
    }

    public function updateWinner(Request $request)
    {
        $raffle = Raffle::find($request->raffle_id);
        if ($raffle) {
            $raffle->winner_number = json_encode($request->winner_numbers); 
            $raffle->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Raffle not found']);
        }
    }

    public function showList()
    {
        $raffles = Raffle::with('raffletor')->get();
        return view('raffle.list', compact('raffles'));
    }
}
