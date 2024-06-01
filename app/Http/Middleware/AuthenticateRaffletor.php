<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticateRaffletor
{

    public function handle($request, Closure $next, $guard = 'raffletor')
    {

        if (!Auth::guard($guard)->check()) {
            return redirect()->route('loginForm');
        }
        
        //Log::info('Autenticado como raffletor');
        return $next($request);
    }
}
