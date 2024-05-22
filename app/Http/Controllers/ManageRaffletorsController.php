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
        // Recuperar los IDs seleccionados del request
        $raffletorIds = $request->input('raffletor_ids', []);

        // Actualizar la columna "estado" a false para los IDs seleccionados
        Raffletor::whereIn('id', $raffletorIds)->update(['status' => false]);

        // Redireccionar o hacer cualquier otra acción después de la actualización
        return redirect()->back()->with('success', 'Estado actualizado con éxito');
    }
}
