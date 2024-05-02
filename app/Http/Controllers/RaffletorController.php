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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages = makeMessages();
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
            // Intentar crear un nuevo Raffletor
            Raffletor::create([
                'name' => $request->name_create,
                'age' => $request->age_create,
                'email' => $request->email_create,
                'password' => bcrypt($password), // Hash de la contraseña
            ]);

            // Redireccionar a la ruta 'raffletors' después de crear con éxito
            return redirect()->route('raffletors')->with('success', 'Sorteador creado exitosamente.');
        } catch (QueryException $e) {
            // Capturar excepción por violación de clave única (correo electrónico duplicado)
            if ($e->errorInfo[1] == 1062) { // Código de error para violación de clave única
                return redirect()->back()->withInput()->withErrors(['email_create' => 'el correo electrónico ingresado ya existe en el sistema']); // Mensaje de error
            } else {
                // Otro tipo de excepción, puedes manejarla como desees
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
