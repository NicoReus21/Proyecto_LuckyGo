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
        <a href="{{ route('loginForm') }}" class="px-4 py-2 bg-white text-black rounded hover:bg-gray-300 transition">Iniciar Sesión</a>
        <a href="{{ route('buyForm') }}" class="px-4 py-2 bg-white text-black rounded hover:bg-gray-300 transition">Comprar Boleto</a>
      </div>
    </nav>
  </header>
  <main class="container mx-auto py-12 px-4">
    <section class="text-center bg-custom-blue text-white py-16 rounded">
      <h1 class="text-4xl font-bold mb-4">Bienvenido a LuckyGO</h1>
      <p class="text-lg">LuckyGO es una plataforma de lotería en línea que te ofrece la oportunidad de ganar grandes premios. Compra tus boletos con facilidad y disfruta de la emoción de la lotería desde la comodidad de tu hogar.</p>
    </section>

    <section class="mt-12">
      <h2 class="text-3xl font-bold text-center mb-6">¿Cómo funciona?</h2>
      <p class="text-lg text-center text-gray-700 mb-8">Sigue estos sencillos pasos para participar en la lotería con LuckyGO.</p>
      <div class="flex flex-col md:flex-row justify-center items-start md:items-center space-y-8 md:space-y-0 md:space-x-8">
        <div class="bg-white  rounded p-6 text-center flex-1">
          <div class="bg-custom-blue text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto text-xl font-bold mb-4">1</div>
          <h3 class="text-xl font-bold mb-2">Regístrate</h3>
          <p class="text-gray-700">Crea una cuenta en LuckyGO de forma rápida y sencilla.</p>
        </div>
        <div class="bg-white  rounded p-6 text-center flex-1">
          <div class="bg-custom-blue text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto text-xl font-bold mb-4">2</div>
          <h3 class="text-xl font-bold mb-2">Compra Boletos</h3>
          <p class="text-gray-700">Adquiere tus boletos de lotería con unos pocos clics.</p>
        </div>
        <div class="bg-white rounded p-6 text-center flex-1">
          <div class="bg-custom-blue text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto text-xl font-bold mb-4">3</div>
          <h3 class="text-xl font-bold mb-2">Gana Premios</h3>
          <p class="text-gray-600">¡Cruza los dedos y espera a que tu número salga premiado!</p>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
