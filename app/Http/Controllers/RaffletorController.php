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

        
        $messages = makeMessages();

        
        $password = mt_rand(100000, 999999);

        
        $request->validate([
            'name_create' => ['required', 'min:3'],
            'age_create' => ['required', 'numeric', 'min:18', 'max:65'],
            'email_create' => ['required', 'email'],
        ], $messages);

        try {
            // Intentar enviar el correo primero.
            Mail::to($request->email_create)->send(new PasswordMailable($password));
            
            // Si el correo se envía correctamente, crear el nuevo sorteador.
            Raffletor::create([
                'name' => $request->name_create,
                'age' => $request->age_create,
                'email' => $request->email_create,
                'password' => bcrypt($password),
            ]);
    
            // Retornar a la vista de sorteadores para seguir ingresando nuevos sorteadores en caso de éxito.
            return redirect()->route('raffletors.create')->with('success', 'Sorteador creado exitosamente.');
    
        } catch (TransportException $e) {
            // Capturamos la excepción con un mensaje de error en pantalla.
            return redirect()->back()->withInput()->withErrors(['error' => 'No se pudo enviar el correo. Se necesita una conexión a Internet.']);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->withInput()->withErrors(['email_create' => 'El correo electrónico ingresado ya existe en el sistema.']); // Mensaje de error
            } else {
                return redirect()->back()->withInput()->withErrors(['error' => 'Error al crear el sorteador.']);
            }
        } catch (\Exception $e) {
            // Capturar cualquier otra excepción no prevista
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocurrió un error inesperado.']);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('loginForm');
    }
}
