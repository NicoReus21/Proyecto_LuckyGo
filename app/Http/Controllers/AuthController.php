<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Raffletor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //Retornamos a la vista de register.
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
        
        
        $messages = makeMessages();
       
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5'],
        ], $messages);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => true
        ]);


        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        
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
        $messages = makeMessages();

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5']
        ], $messages);

        // Intentar autenticar como admin
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->route('raffletors.manage');
        }

        // Verificar si el usuario existe y su estado antes de intentar autenticar como raffletor
        $raffletor = Raffletor::where('email', $request->email)->first();
        if ($raffletor) {
            if (!$raffletor->status) {
                return redirect()->back()->with('message', 'Usuario deshabilitado.');
            }

            // Intentar autenticar como raffletor
            if (Auth::guard('raffletor')->attempt($request->only('email', 'password'), $request->remember)) {
                return redirect()->route('raffle.list');
            }
        }

        return redirect()->back()->with('message', 'Usuario no registrado o contraseña incorrecta.');
    }



    /**
     * Función para poder cerrar sesión.
     */
    public function logout()
    {
        if (Auth::guard('admin')) {
            auth('admin')->logout();
        }

        if (Auth::guard('raffletor')) {
            auth('raffletor')->logout();
        }

        //auth('admin')->logout();
        return redirect()->route('loginForm');
    }
}
