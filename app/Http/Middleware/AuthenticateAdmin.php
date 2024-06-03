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
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (!Auth::guard($guard)->check()) { 
            return redirect()->route('loginForm');
        }
        return $next($request);
    }
}
