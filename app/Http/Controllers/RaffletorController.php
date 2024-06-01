<?php

namespace App\Http\Controllers;

use App\Models\Raffletor;
use Illuminate\Http\Request;
use App\Mail\PasswordMailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
//use Illuminate\Contracts\Auth\Authenticatable;
use Symfony\Component\Mailer\Exception\TransportException;

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
    public function list()
    {

        $raffletors = Raffletor::all();

        // Pasar la variable a la vista
        return view('raffletors.manage', compact('raffletors'));
    }

    public function main()
    {

        // Pasar la variable a la vista
        return view('raffletors.test');
    }

    public function test()
    {
        return view('test');
    }

    public function welcome()
    {
        //Retornamos a la vista de login.
        return view('raffletors.test');
    }

    public function authenticated()
    {
        return redirect('raffletors/area');
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

        //Traemos la lista de mensajes de validación.
        $messages = makeMessages();

        //Generación  de contraseña aleatoria partiendo del 1.
        $password = mt_rand(100000, 999999);

        // Se validan los datos
        $request->validate([
            'name_create' => ['required', 'min:3'],
            'age_create' => ['required', 'numeric', 'min:18', 'max:65'],
            'email_create' => ['required', 'email'],
        ], $messages);

        try {
            // Intentar enviar el correo primero
            Mail::to($request->email_create)->send(new PasswordMailable($password));
            
            // Si el correo se envía correctamente, crear el nuevo sorteador
            Raffletor::create([
                'name' => $request->name_create,
                'age' => $request->age_create,
                'email' => $request->email_create,
                'password' => bcrypt($password),
            ]);
    
            // Retornar a la vista de sorteadores para seguir ingresando nuevos sorteadores en caso de éxito
            return redirect()->route('raffletors.create')->with('success', 'Sorteador creado exitosamente.');
    
        } catch (TransportException $e) {
            // Capturar excepción de transporte de SwiftMailer (usado por Laravel)
            return redirect()->back()->withInput()->withErrors(['error' => 'No se pudo enviar el correo. Se necesita una conexión a Internet.']);
        } catch (QueryException $e) {
            // Capturar excepción por violación de clave única (correo electrónico duplicado)
            if ($e->errorInfo[1] == 1062) { // Código de error para violación de clave única
                return redirect()->back()->withInput()->withErrors(['email_create' => 'El correo electrónico ingresado ya existe en el sistema.']); // Mensaje de error
            } else {
                // Otro tipo de excepción
                return redirect()->back()->withInput()->withErrors(['error' => 'Error al crear el sorteador.']);
            }
        } catch (\Exception $e) {
            // Capturar cualquier otra excepción no prevista
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocurrió un error inesperado.']);
        }

        /* Código Funcionando con el envío de correo.
        try {
            // Se intenta crear un nuevo sorteador
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
            return redirect()->route('raffletors.create')->with('success', 'Sorteador creado exitosamente.');
        } catch (QueryException $e) {
            // Capturar excepción por violación de clave única (correo electrónico duplicado).
            if ($e->errorInfo[1] == 1062) { // Código de error para violación de clave única.
                //Retornamos el error mediante un mensaje.
                return redirect()->back()->withInput()->withErrors(['email_create' => 'el correo electrónico ingresado ya existe en el sistema.']); // Mensaje de error
            } else {
                // Otro tipo de excepción.
                return redirect()->back()->withInput()->withErrors(['error' => 'Error al crear el sorteador.']);
            }
        } */
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('loginForm');
    }
    /*
    public function show(Raffletor $raffletor)
    {
        //
    }

    public function edit(Raffletor $raffletor)
    {
        //
    }

    public function update(Request $request, Raffletor $raffletor)
    {
        //
    }

    public function destroy(Raffletor $raffletor)
    {
        //
    }
*/
}
