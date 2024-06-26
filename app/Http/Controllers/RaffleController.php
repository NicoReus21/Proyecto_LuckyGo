<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raffle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


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
                 
                 if ($request->winner_numbers_lucky === null || empty($request->winner_numbers_lucky)) {
                     $raffle->winner_number_lucky = ''; 
                 } else {
                     $raffle->winner_number_lucky = json_encode($request->winner_numbers_lucky);
                 }
                 
                 $raffle->raffletor_id = Auth::guard('raffletor')->id();
                 $raffle->status = 2;
                 $raffle->updated_at = now();
                 
                 $willBeLucky = 0;

                 $tickets = $raffle->tickets;
         
                 foreach ($tickets as $ticket){
                     if ($ticket->is_will_be_luck){
                         $willBeLucky += 1000;
                     }
                 }

                 if ($willBeLucky < 1000) {
                     $raffle->winner_number_lucky = ''; 
                 }
     
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
        $raffle = Raffle::find($request->raffle_id);     
        $raffle->formatted_date = Carbon::parse($raffle->date)
            ->locale('es')
            ->format('d-m-Y');
        
        $raffle->countTickets = $raffle->tickets->count();
        $raffle->subtotal = $raffle->countTickets * 2000;
        $raffle->willBeLucky = 0;

        $tickets = $raffle->tickets;

        foreach ($tickets as $ticket){
            if ($ticket->is_will_be_luck){
                $raffle->willBeLucky += 1000;
            }
        }

        return view('raffle.register', compact('raffle'));
    }

    /**
     * Muestra la lista de sorteos ordenados por fecha.
     * 
     * @return \Illuminate\View\View
     */
    public function showList()
    {
        
        $raffles = Raffle::with('raffletor')
                    //->orderBy('date', 'asc')
                    ->orderBy('created_at', 'asc')  
                    ->get();
        
        

        foreach ($raffles as $raffle) {
            $raffle->formatted_date = \Carbon\Carbon::parse($raffle->created_at)
            ->locale('es')
            ->isoFormat('dddd, D [de] MMMM');

            $raffle->countTickets = $raffle->tickets->count();
            $raffle->subtotal = $raffle->countTickets * 2000;
            $raffle->willBeLucky = 0;

            $tickets = $raffle->tickets;

            foreach ($tickets as $ticket){
                if ($ticket->is_will_be_luck){
                    $raffle->willBeLucky += 1000;
                }
            }
        }

        foreach ($raffles as $raffle) {
            $raffle->insert_to = \Carbon\Carbon::parse($raffle->updated_at)->format('d-m-Y H:i:s');
        }
        $noRafflesMessage = $raffles->isEmpty() ? 'No hay sorteos en el sistema.' : null;
        return view('raffle.list', compact('raffles', 'noRafflesMessage'));
    }
}
