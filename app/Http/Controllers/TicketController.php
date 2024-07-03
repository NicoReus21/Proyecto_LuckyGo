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
            $currentDate = Carbon::now();
            $nextSunday = $currentDate->next(Carbon::SUNDAY);

            
            $raffle = Raffle::where('status', 3)
                            ->where('end_date', '>=', $currentDate)
                            ->first();

           
            if (!$raffle) {
               
                $expiredRaffle = Raffle::where('status', 3)
                                    ->where('end_date', '<', $currentDate)
                                    ->first();
                if ($expiredRaffle) {
                    $expiredRaffle->status = 1; 
                    $expiredRaffle->save();
                }

                $raffle = Raffle::create([
                    'end_date' => $nextSunday,
                    'status' => 3
                ]);
            }

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
            return back()->with('message', 'Debe ingresar el código del billete');
        } elseif (!$ticket) {
            return back()->with('message', 'El código ingresado no existe');
        }

        $ticketContent = json_decode($ticket->content, true);
        $raffle = Raffle::where('id', $ticket->raffle_id)->first();
        $raffleWinnerNumber = json_decode($raffle->winner_number, true);
        $raffleWinnerNumberLucky = json_decode($raffle->winner_number_lucky, true);

        // Verifica si la decodificación fue exitosa y son arrays
        if (!is_array($ticketContent) || !is_array($raffleWinnerNumber)) {
            return back()->with('message', 'Error al procesar los números del billete o del sorteo');
        }

        if ($raffleWinnerNumberLucky != null && !is_array($raffleWinnerNumberLucky)) {
            return back()->with('message', 'Error al procesar los números del sorteo "Tendré Suerte"');
        }

        // Ordena los arrays
        sort($ticketContent);
        sort($raffleWinnerNumber);
        if ($raffleWinnerNumberLucky != null) {
            sort($raffleWinnerNumberLucky);
        }

        // Verifica si el billete es ganador
        $isWinner = ($ticketContent == $raffleWinnerNumber);
        $isLuckyWinner = ($raffleWinnerNumberLucky != null && $ticketContent == $raffleWinnerNumberLucky && $ticket->is_will_be_luck == true);

        $subtotal = $raffle->tickets->count();
        $raffle->subtotal = $subtotal * 2000;

        $raffle->willBeLucky = 0;

        $tickets = $raffle->tickets;

        foreach ($tickets as $ticketFor) {
            if ($ticketFor->is_will_be_luck) {
                $raffle->willBeLucky += 1000;
            }
        }

        // Formato de la fecha
        $ticket->formatted_date = \Carbon\Carbon::parse($raffle->created_at)->format('d-m-Y H:i:s');
        $raffle->formatted_date = \Carbon\Carbon::parse($raffle->end_date)->setTime(23, 59, 59)->format('d-m-Y H:i:s');

        return view('ticket.validate', compact('ticket', 'raffle', 'isWinner', 'isLuckyWinner', 'ticketContent', 'raffleWinnerNumber', 'raffleWinnerNumberLucky'));
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


