<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Raffletor;


/**
 * Class AuthController
 * 
 * Controlador para manejar la autenticación de usuarios (Inicio de sesión y registrar administradores).
 */
class AuthController extends Controller
{

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
            'email' => ['required', 'email', 'unique:admins'],
            'password' => ['required', 'min:5'],
        ], $messages);

        admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
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
        
        // Se autentica por medio de credenciales si el usuario que intenta ingresar es un administrador.
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->route('raffletors.manage');
        }

        $raffletor = Raffletor::where('email', $request->email)->first();
        if ($raffletor) {
            // Se verifica que el sorteador se encuentra habilitado.
            if (!$raffletor->status) {
                return redirect()->back()->with('message', 'Sorteador deshabilitado.');
            }
            
            // Se autentica por medio de credenciales si el usuario que intenta ingresar es un sorteador.
            if (Auth::guard('raffletor')->attempt($request->only('email', 'password'), $request->remember)) {
                return redirect()->route('raffle.list');
            }
        }

        return redirect()->back()->with('message', 'Usuario no registrado o contraseña incorrecta.');
    }

    /**
     * 
     */

     public function updateName(Request $request)
     {
         $user = Auth::guard('raffletor')->user();
         
         $messages = makeMessages();
         
         $validated = $request->validate([
             'name' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'min:3'],
         ], $messages);
         
         $user->name = $request->name;
         $user->save();
         
         return redirect()->back()->with('message', 'Nombre actualizado correctamente.');
     }
     
     public function updateAge(Request $request)
     {
         $user = Auth::guard('raffletor')->user();
         
         $messages = makeMessages();
         
         $validated = $request->validate([
             'age' => ['required', 'numeric', 'integer', 'min:18', 'max:65'],
         ], $messages);
         
         $user->age = $request->age;
         $user->save();
         
         return redirect()->back()->with('success', 'Edad actualizada correctamente.');
     }
     
     public function updatePassword(Request $request)
     {
         $user = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('raffletor')->user();
     
         if (is_null($user)) {
             return redirect()->back()->with('message', 'No se encontró un usuario autenticado.');
         }
     
         $messages = makeMessages();  

        $validated = $request->validate([
            'password' => ['required', 'numeric', 'regex:/^[1-9]\d{5}$/'],
        ], $messages);

        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('message', 'Las contraseñas no coinciden.');
        }
     
         if ($user instanceof Admin || $user instanceof Raffletor) {
             $user->password = bcrypt($request->password);
             $user->save();
             AuthController::logout();
             return redirect()->back()->with('success', 'Contraseña actualizada correctamente.');
         }
     
         return redirect()->back()->with('message', 'Error al actualizar la contraseña.');
     }


    /**
     * Función para cerrar la sesión actual.
     * 
     * @return \Illuminate\Https\RedirectResponse
     */
    public function logout()
    {
        if (Auth::guard('admin')) {
            auth('admin')->logout();
        }

        if (Auth::guard('raffletor')) {
            auth('raffletor')->logout();
        }

        return redirect()->route('main');
    }

    /**
     * Muestra el formulario de inicio de sesión.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    public function main()
    {
        return view('main.main');
    }

    public function settings()
    {
        if (Auth::guard('admin')->check()) {
            return view('auth.settings', ['user' => Auth::guard('admin')->user()]);
        }
        if (Auth::guard('raffletor')->check()) {
            return view('auth.settings', ['user' => Auth::guard('raffletor')->user()]);
        }

        return redirect()->route('loginForm');
    }

    public function showUpdateNameForm()
    {
        return view('auth.update_name');
    }

    public function showUpdateAgeForm()
    {
        return view('auth.update_age');
    }

    public function showUpdatePasswordForm()
    {
        return view('auth.update_password');
    }


}
