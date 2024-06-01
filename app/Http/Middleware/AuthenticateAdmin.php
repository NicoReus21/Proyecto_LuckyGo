<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{

    public function handle($request, Closure $next, $guard = 'admin')
    {
        
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('loginForm');
        }

        return $next($request);
    }
}
