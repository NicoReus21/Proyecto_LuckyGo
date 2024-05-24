<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raffletor;

class ManageRaffletorsController extends Controller
{

    public function showManageForm()
    {
        $raffletors = Raffletor::withCount('raffles')->get();
        return view('raffletors.manage', compact('raffletors'));
    }


    public function manage(Request $request)
    {

        $statuses = $request->input('statuses', []);

        foreach ($statuses as $id => $status) {
            $raffletor = Raffletor::find($id);
            if ($raffletor) {
                $raffletor->status = ($status == 'Habilitado');
                $raffletor->save();
            }
        }

        return redirect()->back()->with('success', 'Estado actualizado con éxito');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        // Obtener los sorteadores filtrados por nombre o correo electrónico si se proporciona una cadena de búsqueda
        $raffletors = $search ? Raffletor::where('name', 'LIKE', "%$search%")
                                    ->orWhere('email', 'LIKE', "%$search%")
                                    ->get()
                              : Raffletor::all();

        return view('raffletors.manage', compact('raffletors'));
    }

    
}
