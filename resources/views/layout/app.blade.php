<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite("resources/css/styleApp.css")
    <title>LuckyGO</title>
</head>
<body>
    <nav class="menu">
        @auth('web')
        @if (Auth::guard('web')->check() && !Auth::guard('raffletor')->check())
        <ul>
            <li><a href="{{ route('logout') }}">Cerrar Sesión</a></li>
        </ul>
        @endif
        @endauth

        @auth('raffletor')
        @if (Auth::guard('raffletor')->check())
        <ul>
            <li><a href="{{ route('logout') }}">Cerrar Sesión</a></li>
        </ul>
        @endif
        @endauth

        @auth('admin')
        @if (Auth::guard('admin')->check())
        <ul>
            <li><a href="{{ route('logout') }}">Cerrar Sesión</a></li>
        </ul>
        @endif
        @endauth

        
        @guest('web')
        @guest('raffletor')
        <ul>
            <li><a href="{{ route('loginForm') }}">Iniciar Sesión</a></li>
            <!--<li><a href="{{ route('registerForm') }}">Crear Cuenta</a></li>-->
        </ul>
        @endguest
        @endguest
    </nav>

    <main>
        @yield('content')
    </main>
    
</body>
</html>
