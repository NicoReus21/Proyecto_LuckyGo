<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * 
 * Controlador para manejar el inicio de sesión de los usuarios.
 */
class LoginController extends Controller
{
    /**
     * Registrar un nuevo usuarios
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function register(Request $request){

    }

    /**
     * Iniciar sesión para un usuario
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){

        // Credenciales del usuario
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
            //"active" => true
        ];

        // Verificar si las credenciales son válidas
        $remember = ($request->has('remember') ? true : false);

        if(Auth::attempt($credentials,$remember)){

            // Si las credenciases son válidas iniciar sesión 
            $request->session()->regenerate();

            // Redigir al susuario a la pagina de registrar sorteador despues del inicio de sesión
            return redirect()->intended(route('register'));
            
        }else{
            // Si las credenciales no son válidas, redirigir al usuario de vuelta al inicio de sesión
            return redirect('login');
        }

    }
}
