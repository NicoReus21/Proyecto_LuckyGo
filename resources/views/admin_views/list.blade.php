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

        <!-- Contenedor del Campo de Búsqueda -->
        <div class="w-full max-w-md mx-auto mb-8">
            <!-- Campo de Búsqueda -->
            <input type="text" id="searchInput" placeholder="Buscar por nombre o correo electrónico" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>

        <!-- Tabla de Sorteadores -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <!-- Encabezados de la tabla -->
                <tr>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">#</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Nombre</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Correo electrónico</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Edad</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Cantidad de sorteos ingresados</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Estado</th>
                    
                </tr>
            </thead>
            <tbody id="raffletorsTableBody">
                <!-- Datos de ejemplo -->
                <tr class="bg-white">
    <td class="px-4 py-2 border border-gray-300">1</td>
    <td class="px-4 py-2 border border-gray-300">Juan Pérez</td>
    <td class="px-4 py-2 border border-gray-300">juan@example.com</td>
    <td class="px-4 py-2 border border-gray-300">35</td>
    <td class="px-4 py-2 border border-gray-300">10</td>
    <td class="px-4 py-2 border border-gray-300">
        <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            <option value="habilitado">Habilitado</option>
            <option value="deshabilitado">Deshabilitado</option>
        </select>
    </td>
</tr>

                
            </tbody>
        </table>
    </div>

    <!-- Script JavaScript -->
    <script>
        // Código JavaScript para la interactividad y funcionalidad de la página
        // Se generará dinámicamente el contenido de la tabla y se manejará la búsqueda y el cambio de estado de los sorteadores
    </script>
</body>
</html>

@endsection
