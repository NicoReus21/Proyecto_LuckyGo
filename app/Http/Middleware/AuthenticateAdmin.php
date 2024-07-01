<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthenticateAdmin
 * 
 * Middleware para autenticar usuarios administradores.
 */
class AuthenticateAdmin
{
    /**
     * Maneja una solicitud entrante.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, /*$guard = 'admin'*/)
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        } 

        if (Auth::guard('raffletor')->check()) {
            return $next($request);
        }

        return redirect()->route('loginForm')->with('error', 'Por favor, inicie sesión como administrador.');
    }
}
