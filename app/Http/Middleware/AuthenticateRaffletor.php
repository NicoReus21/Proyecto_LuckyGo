<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class AuthenticateRaffletor
 * 
 * Middleware para autenticar usuarios sorteadores.
 */
class AuthenticateRaffletor
{
    /**
     * Maneja una solicitud entrante.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, /*$guard = 'raffletor'*/)
    {
        if (Auth::guard('raffletor')->check()) {
            return $next($request);
        }
        return redirect()->route('loginForm')->with('error', 'Por favor, inicie sesión como raffletor.');
    }
}
