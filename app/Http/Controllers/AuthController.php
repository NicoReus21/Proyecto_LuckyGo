<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Raffletor;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        //Retornamos a la vista de login.
        return view('auth.login');
    }

    public function registerForm()
    {
        //Retornamos a la vista de register.
        return view('auth.register');
    }


    /**
     * Función para registrar un nuevo ususario.
     */
    public function register(Request $request)
    {

        //Traemos la lista de mensajes de validación.
        $messages = makeMessages();

        //Validar Datos
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5']
        ], $messages);

        //Crear el usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Autenticar el usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        //Redireccionar al usuario
        return redirect()->route('raffletors');
    }

    public function login(Request $request)
    {

        //Traemos la lista de mensajes de validación.
        $messages = makeMessages();

        //Validar datos
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5']
        ], $messages);

        //Autentica el usuario
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->back()->with('message', 'Usuario no registrado o contraseña incorrecta.');
        }

        //Redirecciona el usuario
        return redirect()->route('raffletors');
    }


    /**
     * Función para poder cerrar sesión.
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('loginForm');
    }
}
