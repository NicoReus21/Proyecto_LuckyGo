<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ticket;
use App\Models\Raffle;
use PHPUnit\Framework\Attributes\Ticket as AttributesTicket;
use Carbon\Carbon;

class TicketController extends Controller
{

    public function buy(Request $request)
    {
        $selectedNumbers = implode(',', $request->numbers);
        $isWillBeLuck = $request->input('category') ? true : false;

        if ($isWillBeLuck){
            $luckyNumbers = $selectedNumbers;
        } else {
            $luckyNumbers = ' ';
        }

        DB::transaction(function () use ($selectedNumbers, $isWillBeLuck, $luckyNumbers) {
            $nextSunday = Carbon::now()->next(Carbon::SUNDAY);

            $raffle = Raffle::firstOrCreate(
                ['status' => 3],
                [
                    'ticket_quantity' => 0, 
                    'subtotal' => 0, 
                    'will_be_lucky' => 0, 
                    'date' => now(), 
                    'end_date' => $nextSunday
                ]
            );

            $raffle->ticket_quantity += 1;
            $raffle->subtotal += 2000;
            if ($isWillBeLuck) {
                $raffle->will_be_lucky += 1000;
            }
            $raffle->save();

            $code = 'LG' . mt_rand(100, 999);

            Ticket::create([
                'code' => $code,
                'date' => now(),
                'content' => $selectedNumbers,
                'content_luck' => $luckyNumbers,
                'is_will_be_luck' => $isWillBeLuck,
                'raffle_id' => $raffle->id
            ]);
        });

        return redirect()->route('ticket.buy')->with('success', 'Boleto comprado exitosamente.');
    }


/*
    public function validate_ticket(Request $request)
    {
        $ticket_number = $request->ticket_code; // Supongo que aquí está el código del ticket
        $ticket = Ticket::where('ticket_numbers', $ticket_number)->first();

        if (!$ticket) {
            return back()->with('message', 'Ticket no encontrado');
        }

        $raffle = Raffle::where('id', $ticket->raffle_id)->first();

        // Aquí estableces una relación, pero los datos están en la misma tabla de raffles
        // Además, se asume que la columna código del sorteo ya está en la tabla tickets

        return view('ticket.ticket_validator')->with('ticket', $ticket)->with('raffle', $raffle);
    }

*/
/*
    public function detailsForm()
    {
        return view('ticket.details2');
    }
    */
 
    public function buyForm()
    {
        return view('ticket.buy');
    }

    

}


