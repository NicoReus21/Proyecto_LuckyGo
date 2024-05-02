<?php

namespace App\Http\Controllers;

use App\Models\Raffletor;
use Illuminate\Http\Request;
use App\Mail\PasswordMailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;

/**
 * Class RaffletorController
 * 
 * Controlador para manejar las operaciones relacionadas a los sorteadores.
 */

class RaffletorController extends Controller
{
    /**
     * Despliega una lista con los sorteadores.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('raffletors.create');
    }

    /**
     * Muestra un formulario para crear un nuevo sorteador.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('raffletors.create');
    }

    /**
     * Almacena un nuevo sorteador en la base de datos.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $messages = makeMessages();
        $password = mt_rand(100000, 999999);

        // Se validan los datos
        $request->validate([
            'name_create' => ['required', 'min:3'],
            'age_create' => ['required', 'numeric', 'min:18', 'max:65'],
            'email_create' => ['required', 'email'],
        ], $messages);

        // Crea el sorteador
        /**
        Raffletor::create([
            'name' => $request->name_create,
            'age' => $request->age_create,
            'email' => $request->email_create,
            'password' => bcrypt($password),
        ]);

        //Redirecciona el sorteador
        return redirect()->route('raffletors');
         **/


        try {
            // Se intenta crear un nuevo sorteador
            Raffletor::create([
                'name' => $request->name_create,
                'age' => $request->age_create,
                'email' => $request->email_create,
                'password' => bcrypt($password), // Hash de la contraseña
            ]);

            // Redireccionar a la ruta 'raffletors' después de crear con éxito
            return redirect()->route('raffletors')->with('success', 'Sorteador creado exitosamente.');
        } catch (QueryException $e) {
            // Capturar excepción por correo electrónico duplicado
            if ($e->errorInfo[1] == 1062) { // Código de error para violación de clave única
                return redirect()->back()->withInput()->withErrors(['email_create' => 'el correo electrónico ingresado ya existe en el sistema']);
            } else {
                // Otro tipo de excepción
                return redirect()->back()->withInput()->withErrors(['error' => 'Error al crear el sorteador.']);
            }
        }
    }

    /**
     * Muetra la información de un sorteador especpifico.
     * 
     * @param \App\Models\Raffletor $raffletor
     * @return
     */
    public function show(Raffletor $raffletor)
    {
        //
    }

    /**
     * Edita la informacion de un sorteador.
     * 
     * @param \App\Models\Raffletor $raffletor
     * @return
     */
    public function edit(Raffletor $raffletor)
    {
        //
    }

    /**
     * Actualiza la información de un sorteador.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Raffletor $raffletor
     * @return
     */
    public function update(Request $request, Raffletor $raffletor)
    {
        //
    }


    /**
     * Elimina un sorteador específico.
     * 
     * @param \Illuminate\Http\Raffletor $raffletor
     * @return
     */
    public function destroy(Raffletor $raffletor)
    {
        //
    }
}
