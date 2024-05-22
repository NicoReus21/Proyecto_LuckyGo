@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Sorteadores</title>
    <!-- Incluir Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Contenedor principal con margen superior -->
    <div class="container mx-auto py-8 mt-12">
        <!-- Título de la página -->
        <h1 class="text-3xl font-bold text-center mb-8">Listado de Sorteadores</h1>

        @if (session('success'))
            <div class="text-green-500 mb-8 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Contenedor del Campo de Búsqueda -->
        <div class="w-full max-w-md mx-auto mb-8">
            <!-- Campo de Búsqueda -->
            <input type="text" id="searchInput" placeholder="Buscar por nombre o correo electrónico" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>

        <!-- Formulario para enviar los sorteadores seleccionados -->
        <form method="POST" action="{{ route('raffletors.manage.post') }}">
            @csrf

            <!-- Tabla de Sorteadores -->
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <!-- Encabezados de la tabla -->
                    <tr>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">#</th>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Nombre</th>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Correo electrónico</th>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Edad</th>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Seleccionar</th>
                    </tr>
                </thead>
                <tbody id="raffletorsTableBody">
                    @foreach($raffletors as $raffletor)
                    <tr class="bg-white">
                        <td class="px-4 py-2 border border-gray-300">{{ $raffletor->id }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $raffletor->name }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $raffletor->email }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $raffletor->age }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            <input type="checkbox" name="raffletor_ids[]" value="{{ $raffletor->id }}" class="w-4 h-4">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="mt-8 w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Mandar petición</button>
        </form>
    </div>

    <!-- Script JavaScript -->
    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#raffletorsTableBody tr');

            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const email = row.children[2].textContent.toLowerCase();
                if (name.includes(filter) || email.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>

@endsection
