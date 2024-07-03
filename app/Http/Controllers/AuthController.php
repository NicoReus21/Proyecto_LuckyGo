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
    /*
    public function updateProfile(Request $request)
    {

        $messages = makeMessages();

        $user = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('raffletor')->user();

        // Verificar si el usuario está correctamente autenticado
        if (is_null($user)) {
            return redirect()->back()->with('error', 'No se encontró un usuario autenticado.');
        }

        // Validar la solicitud
        $validated = $request->validate([
            'password' => ['nullable', 'numeric' ,'regex:/^[1-9]\d{5}$/'],
            'name' => ['nullable', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/' ,'min:3'],
            'age' => ['nullable','numeric','integer','min:18', 'max:65']
        ], $messages);
        //dd($request);
        // Actualizar el perfil basado en el tipo de usuario
        if ($user instanceof Admin) {
            if ($request->filled('password') && $request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);   
                AuthController::logout();
            }else {
                return redirect()->back()->with('message', 'Contraseñas no coinciden.');
            }

        } elseif ($user instanceof Raffletor) {
            if ($request->filled('name')) {
                $user->name = $request->name;
            }
            if ($request->filled('age')) {
                $user->age = $request->age;
            }
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
                AuthController::logout();
            }
        } 

        
        // Guardar el objeto usuario
        if ($user->save()) {
            return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
        } else {
            return redirect()->back()->with('message', 'No se pudo actualizar el perfil.');
        }

    }
*/

    public function updateProfile(Request $request)
    {
        $messages = makeMessages();
        // Obtener el usuario autenticado basado en el guard
        $user = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('raffletor')->user();

        // Verificar si el usuario está correctamente autenticado
        if (is_null($user)) {
            return redirect()->back()->with('error', 'No se encontró un usuario autenticado.');
        }

        $validated = $request->validate([
            'password' => ['nullable', 'numeric' ,'regex:/^[1-9]\d{5}$/'],
            'name' => ['nullable', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/' ,'min:3'],
            'age' => ['nullable','numeric','integer','min:18', 'max:65']
        ], $messages);


        // Actualizar el perfil basado en el tipo de usuario
        if ($user instanceof Admin) {
            if ($request->filled('password') && $request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);   
                AuthController::logout();
            }else {
                return redirect()->back()->with('message', 'Contraseñas no coinciden.');
            }

        } elseif ($user instanceof Raffletor) {
            if ($request->filled('name')) {
                $user->name = $request->name;
            } 
            if ($request->filled('age')) {
                $user->age = $request->age;
            } 
            if ($request->filled('password') && $request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);
                AuthController::logout();
            }
        } 

        // Guardar el objeto usuario
        if (method_exists($user, 'save')) {
            $user->save();
            return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
        } else {
            return redirect()->back()->with('error', 'El método save no está disponible en el objeto usuario.');
        }
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

}
