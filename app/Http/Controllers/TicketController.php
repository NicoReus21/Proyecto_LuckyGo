<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ticket;
use App\Models\Raffle;
use PHPUnit\Framework\Attributes\Ticket as AttributesTicket;
use Carbon\Carbon;

use function PHPUnit\Framework\isNull;

class TicketController extends Controller
{

    public function buy(Request $request)
{
    $selectedNumbers = implode(',', $request->numbers);
    $isWillBeLuck = $request->input('category') ? true : false;
    $ticketId = $request->input('ticket_id');

    DB::transaction(function () use ($selectedNumbers, $isWillBeLuck, $ticketId) {
        $nextSunday = Carbon::now()->next(Carbon::SUNDAY);

        $raffle = Raffle::firstOrCreate(
            ['status' => 3],
            [
                'end_date' => $nextSunday
            ]
        );

        $raffle->save();

        Ticket::create([
            'code' => $ticketId,
            'content' => $selectedNumbers,
            'is_will_be_luck' => $isWillBeLuck,
            'raffle_id' => $raffle->id
        ]);
    });

    return redirect()->route('ticket.buy')->with('success', 'Boleto comprado exitosamente.');
}
    public function validate_ticket(Request $request)
    {


        $ticket_number = $request->ticket_code; 
        $ticket = Ticket::where('code', $ticket_number)->first();

        if ($ticket_number == null) {
            return back()->with('message', 'debe ingresar el código del billete');
        }
        elseif(!$ticket){
            return back()->with('message', 'el código ingresado no existe');
        }

        $ticket->content = json_decode($ticket->content, true);
        $raffle = Raffle::where('id', $ticket->raffle_id)->first();
        $raffle->winner_number = json_decode($raffle->winner_number, true);
        $raffle->winner_number_lucky = json_decode($raffle->winner_number_lucky, true);
        
        $subtotal = $raffle->tickets->count();
        $raffle->subtotal=$subtotal*2000;

        $raffle->willBeLucky = 0;

        $tickets = $raffle->tickets;

        foreach ($tickets as $ticketFor){
            if ($ticketFor->is_will_be_luck){
                $raffle->willBeLucky += 1000;
            }
        }
        
        // formato de la fecha

        $ticket->formatted_date = \Carbon\Carbon::parse($raffle->created_at)->format('d-m-Y H:i:s');
        $raffle->formatted_date = \Carbon\Carbon::parse($raffle->created_at)->format('d-m-Y H:i:s');

        
        return view('ticket.validate')->with('ticket', $ticket)->with('raffle', $raffle);
    }


    public function buyForm()
    {
        return view('ticket.buy');
    }

    public function validateForm()
    {
        return view('ticket.validate');
    }

}


