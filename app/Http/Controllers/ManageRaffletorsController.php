<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raffletor;

class ManageRaffletorsController extends Controller
{
    /**
     * Muestra el formulario de gestión de sorteadores.
     * 
     * @return \Illuminate\View\View
     */
    public function showManageForm()
    {


        $raffletors = Raffletor::withCount('raffles')
            ->orderBy('name', 'asc')
            ->get();
        return view('raffletors.manage', compact('raffletors'));
    }

    /**
     * Gestiona la actualización del estado de los sorteadores.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function manage(Request $request)
    {
        
        $statuses = $request->input('statuses', []);

       
        foreach ($statuses as $id => $status) {
            // Busca el sorteador por su ID
            $raffletor = Raffletor::find($id);
            if ($raffletor) {
                
                $raffletor->status = ($status == 'Habilitado');
                $raffletor->save();
            }
        }

       
        return redirect()->back()->with('success', 'Estado actualizado con éxito');
    }

    /**
     * Muestra la lista de sorteadores, con opción de búsqueda.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        $search = $request->input('search');

        
        $raffletors = $search ? Raffletor::where('name', 'LIKE', "%$search%")
                                    ->orWhere('email', 'LIKE', "%$search%")
                                    ->get()
                              : Raffletor::all();

        
        return view('raffletors.manage', compact('raffletors'));
    }
}
