<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ticket;
use App\Models\Raffle;


class TicketController extends Controller
{
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
    public function purchaseForm()
    {
        return view('user.buy_ticket');
    }

    public function purchase(Request $request)
    {
        // Lógica para la compra de boletos.
        // Validar y procesar la compra.

        return redirect()->route('ticket.purchase')->with('success', 'Boleto comprado exitosamente.');
    }
/*
    public function detailsForm()
    {
        return view('ticket.details2');
    }
    */
}
