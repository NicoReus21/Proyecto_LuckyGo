@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Billete</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
    <div class="container mx-auto py-8 mt-12">
      
        <h1 class="text-3xl font-bold text-center mb-8">Verificador de Billete</h1>

        @if (isset($noTicketsMessage))
            <div class="text-red-500 mb-8 text-center">
                {{ $noTicketsMessage }}
            </div>
        @endif

        <h2 class="text-xl font-bold mb-4">Detalles de tu Billete</h2>
        <table class="w-full border-collapse border border-gray-300 mb-8">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Fecha del Billete</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Números Jugados</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td class="px-4 py-2 border border-gray-300">{{ $ticket->formatted_date }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $ticket->numbers_played }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="text-xl font-bold mb-4">Detalles del Sorteo</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Fecha del Sorteo</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Números Ganadores</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Números Ganadores "Tendré Suerte"</th>
                </tr>
            </thead>
            <tbody>
                @foreach($raffles as $raffle)
                <tr>
                    <td class="px-4 py-2 border border-gray-300">{{ $raffle->formatted_date }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $raffle->winning_numbers }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $raffle->will_be_lucky }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</body>
</html>
@endsection