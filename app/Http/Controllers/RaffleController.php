<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raffle;

class RaffleController extends Controller
{
    public function registerForm()
    {
        $raffle = Raffle::latest()->first(); // Obtener el sorteo más reciente
        return view('raffle.register', compact('raffle'));
    }

    public function updateWinner(Request $request)
    {
        $raffle = Raffle::find($request->raffle_id);
        if ($raffle) {
            $raffle->winner_number = json_encode($request->winner_numbers); // Suponiendo que winner_number almacena los números ganadores como JSON
            $raffle->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Raffle not found']);
        }
    }
}

?>

