<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateRaffletor
{

    public function handle($request, Closure $next)
    {
        if (!Auth::guard('raffletors')->check()) {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
