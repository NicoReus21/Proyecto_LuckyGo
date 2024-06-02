@extends('layout.app2')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Sorteadores</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
    <div class="container mx-auto py-8 mt-12">
      
        <h1 class="text-3xl font-bold text-center mb-8">Listado des</h1>

       
        @if (session('success'))
            <div class="text-green-500 mb-8 text-center">
                {{ session('success') }}
            </div>
        @endif

       
        <form method="POST" action="{{ route('raffletors.index') }}" class="w-full max-w-md mx-auto mb-8">
        @csrf 
            <input type="text" name="search" placeholder="Buscar por nombre o correo electrónico" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" value="{{ request('search') }}">
           
            <button type="submit" class="hidden"></button>
        </form>

        
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">#</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Fecha del sorteo</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Cantidad de billetes</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Subtotal de billetes</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Tendré Suerte</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Total</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Estado</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Ingresado por</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rowNumber = 1; // Inicializamos el contador de fila
                @endphp
                @foreach($raffletors->sortBy('name') as $raffletor)
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
</body>
</html>
@endsection
