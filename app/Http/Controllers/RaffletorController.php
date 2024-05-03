<?php

namespace App\Http\Controllers;


use App\Models\Raffletor;
use Illuminate\Http\Request;
use App\Mail\PasswordMailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;

class RaffletorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('raffletors.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('raffletors.create');
    }

    /**
     * Función para registrar un nuevo sorteador.
     */
    public function store(Request $request)
    {

        //Traemos la lista de mensajes de validación.
        $messages = makeMessages();

        //Generación  de contraseña aleatoria partiendo del 1.
        $password = mt_rand(100000, 999999);

        //Validar datos
        $request->validate([
            'name_create' => ['required', 'min:3'],
            'age_create' => ['required', 'numeric', 'min:18', 'max:65'],
            'email_create' => ['required', 'email'],
        ], $messages);

        //Crea el sorteador
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
            // Intentar crear un nuevo sorteador.
            Raffletor::create([
                'name' => $request->name_create,
                'age' => $request->age_create,
                'email' => $request->email_create,
                'password' => bcrypt($password),
            ]);


            //Hacemos el envio del correo con la nueva contraseña.
            Mail::to($request->email_create)->send(new PasswordMailable($password));

            //Retornamos a la vista de sorteadores para seguir ingresando nuevos sorteadores en caso de.
            return redirect()->route('raffletors')->with('success', 'Sorteador creado exitosamente.');
        } catch (QueryException $e) {
            // Capturar excepción por violación de clave única (correo electrónico duplicado).
            if ($e->errorInfo[1] == 1062) { // Código de error para violación de clave única.
                //Retornamos el error mediante un mensaje.
                return redirect()->back()->withInput()->withErrors(['email_create' => 'el correo electrónico ingresado ya existe en el sistema']); // Mensaje de error
            } else {
                // Otro tipo de excepción.
                return redirect()->back()->withInput()->withErrors(['error' => 'Error al crear el sorteador.']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Raffletor $raffletor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Raffletor $raffletor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Raffletor $raffletor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Raffletor $raffletor)
    {
        //
    }
}
