@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Sorteadores</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8 mt-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-center w-full">Listado de Sorteadores</h1>
        </div>

        @if (session('success'))
            <div class="text-green-500 mb-8 text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="w-full max-w-md mx-auto mb-8">
            <input type="text" id="searchInput" placeholder="Buscar por nombre o correo electrónico" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>

        <form method="POST" action="{{ route('raffletors.manage.post') }}">
            @csrf
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">#</th>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Nombre</th>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Correo electrónico</th>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Edad</th>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300 header-multiline">Cantidad<br>de Sorteos</th>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Estado</th>
                    </tr>
                </thead>
                <tbody id="raffletorsTableBody">
                    @php
                        $rowNumber = 1;
                    @endphp
                    @foreach($raffletors->sortBy('name') as $raffletor)
                    <tr class="bg-white">
                        <td class="px-4 py-2 border border-gray-300">{{ $rowNumber++ }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $raffletor->name }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $raffletor->email }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $raffletor->age }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $raffletor->raffle_count }}</td>
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

            <div class="flex justify-center space-x-4 mt-8 mx-4">
                <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-700">Actualizar</button>
                <i class="bi bi-arrow-clockwise"></i>
                <a href="{{ route('raffletors.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-700">Agregar Sorteador</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#raffletorsTableBody tr');

            let rowNumber = 1;

            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const email = row.children[2].textContent.toLowerCase();
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
