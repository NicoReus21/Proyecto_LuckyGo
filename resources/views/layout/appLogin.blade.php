<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LuckyGO</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-white text-black">
  <header class="bg-custom-blue text-white py-4">
    <nav class="container mx-auto flex items-center justify-between px-4">
      <div class="flex items-center space-x-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="h-6 w-6"
        >
          <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
          <path d="M13 5v2"></path>
          <path d="M13 17v2"></path>
          <path d="M13 11v2"></path>
        </svg>
        <a class="text-xl font-bold">LuckyGO</a>
      </div>
      <div class="space-x-4">
        @guest('web')
        @guest('raffletor')
        <a href="{{ route('loginForm') }}" class="px-4 py-2 bg-white text-black rounded hover:bg-gray-300 transition">Iniciar Sesión</a>
        <a href="{{ route('buyForm') }}" class="px-4 py-2 bg-white text-black rounded hover:bg-gray-300 transition">Comprar Boleto</a>
        @endguest
        @endguest

        @auth('web')
        @if (Auth::guard('web')->check() && !Auth::guard('raffletor')->check())
        <a href="{{ route('logout') }}" class="px-4 py-2 bg-white text-black rounded hover:bg-gray-300 transition">Cerrar Sesión</a>
        @endif
        @endauth

        @auth('raffletor')
        @if (Auth::guard('raffletor')->check())
        <a href="{{ route('logout') }}" class="px-4 py-2 bg-white text-black rounded hover:bg-gray-300 transition">Cerrar Sesión</a>
        @endif
        @endauth

        @auth('admin')
        @if (Auth::guard('admin')->check())
        <a href="{{ route('logout') }}" class="px-4 py-2 bg-white text-black rounded hover:bg-gray-300 transition">Cerrar Sesión</a>
        @endif
        @endauth
      </div>
    </nav>
  </header>
  <main class="container mx-auto py-12 px-4">
    @yield('content')
  </main>
</body>
</html>