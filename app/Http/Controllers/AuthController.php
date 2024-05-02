<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Raffletor;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $messages = makeMessages();
        //Validar Datos
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'emailLogin' => ['required', 'email', 'unique:users'],
            'passwordLogin' => ['required', 'min:5']
        ], $messages);

        //Crear el usuario
        User::create([
            'name' => $request->name,
            'emailLogin' => $request->email,
            'passwordLogin' => $request->password
        ]);

        //Autenticar el usuario
        auth()->attempt([
            'emailLogin' => $request->email,
            'passwordLogin' => $request->password,
        ]);

        //Redireccionar al usuario
        return redirect()->route('raffletors');
    }

    public function login(Request $request)
    {

        $messages = makeMessages();
        //Validar datos
        $request->validate([
            'emailLogin' => ['required', 'email'],
            'passwordLogin' => ['required', 'min:5']
        ], $messages);

        $credentials = [
            'email' => $request->emailLogin,
            'password' => $request->passwordLogin
        ];

        //Autentica el usuario
        if (!auth()->attempt($credentials, $request->remember)) {
            return redirect()->back()->with('message', 'Credenciales incorrectas');
        }

        //Redirecciona el usuario
        return redirect()->route('raffletors');
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('loginForm');
    }
}
