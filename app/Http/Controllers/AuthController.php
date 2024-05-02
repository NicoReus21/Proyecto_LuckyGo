<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Raffletor;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * 
 * Controlador para manejar la autenticación de usuarios (Inicio de sesión y registrar sorteador).
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Muestra el formulario de registro de sorteadores.
     * 
     * @return \Illuminate\Contract\View\View
     */
    public function registerForm()
    {
        return view('auth.register');
    }

    /**
     * Procesa la solicitud de registro de un nuevo sorteador.
     * 
     * @param \Illuminate\Https\Request $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {

        // Se validan los datos
        $messages = makeMessages();
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5']
        ], $messages);

        // se crear el sorteador
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        // Autenticar el sorteador
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Redireccionar al usuario
        return redirect()->route('raffletors');
    }

    /**
     * Procesa la solicitud de inicio de sesión de un usuario.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Https\RedirectResponse
     */
    public function login(Request $request)
    {

        // Validar datos
        $messages = makeMessages();
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5']
        ], $messages);

        // Autentica el usuario
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->back()->with('message', 'Usuario no registrado o contraseña incorrecta.');
        }

        // Redirecciona el usuario
        return redirect()->route('raffletors');
    }

    /**
     * Cierra la sesión de usuario actual.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('loginForm');
    }
}
