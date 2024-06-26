@extends('layout.app2')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Sorteadores</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800 flex flex-col min-h-screen">
    <div class="container mx-auto flex-grow flex flex-col justify-center py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Listado de Sorteadores</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 border border-green-200 rounded-lg p-4 mb-8 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if (isset($noRaffletorsMessage))
            <div class="bg-red-100 text-red-700 border border-red-200 rounded-lg p-4 mb-8 text-center">
                {{ $noRaffletorsMessage }}
            </div>
        @endif

        <div class="w-full max-w-md mx-auto mb-8">
            <input title="Busca al sorteador por nombre o correo electrónico." type="text" id="searchInput" placeholder="Buscar por nombre o correo electrónico" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>

        <div class="bg-blue-100 text-center text-blue-700 border border-blue-200 rounded-lg p-4 mb-8">
            <p class="text-bold">Para confirmar el estado de los sorteadores debe presionar el botón "Actualizar".</p>
        </div>

        <form method="POST" action="{{ route('raffletors.manage.post') }}">
            @csrf
            <div class="overflow-x-auto h-60">
                <table class="min-w-full border border-gray-300 rounded-lg">
                    <thead>
                        <tr>
                            <th title="Representa el ID de cada sorteador." class="px-4 py-2 bg-gray-200 border border-gray-300">#</th>
                            <th title="Representa el nombre de cada sorteador." class="px-4 py-2 bg-gray-200 border border-gray-300">Nombre</th>
                            <th title="Representa el correo electrónico de cada sorteador." class="px-4 py-2 bg-gray-200 border border-gray-300">Correo electrónico</th>
                            <th title="Representa la edad de cada sorteador." class="px-4 py-2 bg-gray-200 border border-gray-300">Edad</th>
                            <th title="Representa la cantidad de sorteos ingresados de cada sorteador." class="px-4 py-2 bg-gray-200 border border-gray-300">Cantidad de Sorteos</th>
                            <th title="Representa el estado(habilitado/deshabilitado) de cada sorteador." class="px-4 py-2 bg-gray-200 border border-gray-300">Estado</th>
                        </tr>
                    </thead>
                    <tbody id="raffletorsTableBody" class="max-h-64 overflow-y-auto">
                        @php
                            $rowNumber = 1;
                        @endphp
                        @foreach($raffletors as $raffletor)
                        <tr class="bg-white">
                            <td class="px-4 py-2 border border-gray-300">{{ $rowNumber++ }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $raffletor->name }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $raffletor->email }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $raffletor->age }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $raffletor->raffles_count }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                <select name="statuses[{{ $raffletor->id }}]" class="w-full px-2 py-1 border border-gray-300 rounded-md">
                                    <option value="Habilitado" {{ $raffletor->status ? 'selected' : '' }}>Habilitado</option>
                                    <option value="Deshabilitado" {{ !$raffletor->status ? 'selected' : '' }}>Deshabilitado</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-center space-x-4 mt-8">
                <button title="Actualiza la página para observar los cambios."type="submit" class="bg-orange-400 text-white px-6 py-3 rounded-md hover:bg-orange-600 flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                    </svg>
                    <span>Actualizar</span>
                </button>
                <a href="{{ route('raffletors.create') }}" class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-700">Agregar Sorteador</a>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('searchInput').addEventListener('input', function () {
        const filter = this.value.toLowerCase().replace(/\s/g, ''); 
        const rows = document.querySelectorAll('#raffletorsTableBody tr');

        let rowNumber = 1;

        rows.forEach(row => {
            const name = row.children[1].textContent.toLowerCase().replace(/\s/g, ''); 
            const email = row.children[2].textContent.toLowerCase().replace(/\s/g, ''); 
            if (name.includes(filter) || email.includes(filter)) {
                row.style.display = '';
                row.children[0].textContent = rowNumber++;
            } else {
                row.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>
@endsection