<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raffle;

class RaffleController extends Controller
{
    /**
     * Muestra el formulario para registrar los números ganadores de un sorteo.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function registerForm(Request $request)
    {
        
        $raffle = Raffle::find($request->raffle_id);
        
        
        return view('raffle.register', compact('raffle'));
    }

    /**
     * Actualiza los números ganadores de un sorteo.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Muestra la lista de sorteos.
     * 
     * @return \Illuminate\View\View
     */
    public function showList()
    {
        // Obtiene todos los sorteos junto con el sorteador asociado
        $raffles = Raffle::with('raffletor')->get();
        
        
        return view('raffle.list', compact('raffles'));
    }
}
