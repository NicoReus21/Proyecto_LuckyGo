<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectIfRaffletorAuthenticated
 * 
 * Middleware para redirigir a los usuarios sorteadores autenticados.
 */
class RedirectIfRaffletorAuthenticated
{
    /**
     * Maneja una solicitud entrante.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // Verifica si el usuario está autenticado usando el guardia especificado
        if (Auth::guard($guard)->check()) {
            // Si está autenticado, redirige al login
            return redirect('login');
        }

        // Si no está autenticado, permite que la solicitud continúe al siguiente middleware o controlador
        return $next($request);
    }
}
