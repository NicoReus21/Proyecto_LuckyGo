<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raffle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class RaffleController extends Controller
{

    /**
     * Actualiza los números ganadores de un sorteo.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateWinner(Request $request)
    {
        try {
            $raffle = Raffle::find($request->raffle_id);
            if ($raffle) {
                $raffle->winner_number = json_encode($request->winner_numbers); 
                $raffle->raffletor_id =  Auth::guard('raffletor')->id();
                $raffle->status = 2;
                $raffle->save();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Raffle not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Muestra el formulario para registrar los números ganadores de un sorteo.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function registerForm(Request $request)
    {
        //$raffle = Raffle::latest()->first();
        $raffle = Raffle::find($request->raffle_id);     
        return view('raffle.register', compact('raffle'));
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
        $raffles = Raffle::with('raffletor')->get(); 
        return view('raffle.list', compact('raffles'));
    }
}
