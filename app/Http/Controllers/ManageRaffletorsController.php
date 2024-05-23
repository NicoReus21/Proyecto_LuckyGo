<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raffletor;

class ManageRaffletorsController extends Controller
{
    // Manejar la solicitud GET
    public function showManageForm()
    {
        $raffletors = Raffletor::all();
        return view('raffletors.manage', compact('raffletors'));
    }

    // Manejar la solicitud POST
    public function manage(Request $request)
    {
        // Recuperar los estados seleccionados del request
        $statuses = $request->input('statuses', []);

        // Iterar sobre los estados para actualizar cada sorteador
        foreach ($statuses as $id => $status) {
            $raffletor = Raffletor::find($id);
            if ($raffletor) {
                $raffletor->status = ($status == 'Habilitado');
                $raffletor->save();
            }
        }

        // Redireccionar o hacer cualquier otra acción después de la actualización
        return redirect()->back()->with('success', 'Estado actualizado con éxito');
    }

   //Busqueda
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $raffletors = Raffletor::where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orderBy('name')
                ->get();
        } else {
            $raffletors = Raffletor::orderBy('name')->get();
        }
    
        return view('raffletors.index', compact('raffletors'));
    }
    

}
