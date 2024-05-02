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

        @auth
        <ul>
            <li><a href="{{ route("logout") }} ">Cerrar Sesion</a></li>
        </ul>
        @endauth

        @guest
        <ul>
            <li><a href=" {{ route("loginForm") }} ">Iniciar Sesion</a></li>
            <li><a href=" {{ route("registerForm") }} ">Crear Cuenta</a></li>
        </ul> 
        @endguest


        
    </nav>

    <main>
        @yield('content')
    </main>
    
</body>
</html>