<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
 
    public function buyForm()
    {
        return view('ticket.buy');
    }

    public function buy(Request $request)
    {
        // Lógica para la compra de boletos.
        // Validar y procesar la compra.

        return redirect()->route('ticket.buy')->with('success', 'Boleto comprado exitosamente.');
    }

}


