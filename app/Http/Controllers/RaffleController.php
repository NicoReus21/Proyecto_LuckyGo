<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raffle;
use Illuminate\Support\Facades\Log;


class RaffleController extends Controller
{
    public function registerForm()
    {
        $raffle = Raffle::latest()->first(); // Obtener el sorteo más reciente
        return view('raffle.register', compact('raffle'));
    }

    public function updateWinner(Request $request)
    {
        try {
            $raffle = Raffle::find($request->raffle_id);
            if ($raffle) {
                $raffle->winner_number = json_encode($request->winner_numbers); 
                $raffle->save();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Raffle not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

?>

