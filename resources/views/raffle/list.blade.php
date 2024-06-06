@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Sorteos</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
    <div class="container mx-auto py-8 mt-12">
      
        <h1 class="text-3xl font-bold text-center mb-8">Listado de Sorteos</h1>

        @if (isset($noRafflesMessage))
            <div class="text-red-500 mb-8 text-center">
                {{ $noRafflesMessage }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Fecha del sorteo</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Cantidad de billetes</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Subtotal de billetes</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">"Tendré Suerte"</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Total</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Estado</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Ingresado por</th>
                </tr>
            </thead>
            <tbody>
                @foreach($raffles as $raffle)
                <tr>
                    <td class="px-4 py-2 border border-gray-300">{{ $raffle->formatted_date }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $raffle->ticket_quantity }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $raffle->subtotal }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $raffle->will_be_lucky }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $raffle->will_be_lucky + $raffle->subtotal }}</td>
                    <td class="px-4 py-2 border border-gray-300">
                    @if ($raffle->status == 1)
                        No realizado 
                        <form action="{{ route('raffle.register') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="raffle_id" value="{{ $raffle->id }}">
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded-md hover:bg-green-700 ml-2">Ingresar</button>
                        </form>
                    @elseif ($raffle->status == 2)
                        Realizado
                    @else
                        Abierto
                    @endif
                    </td>
                    <td class="px-4 py-2 border border-gray-300">
                        @if( $raffle->raffletor_id == null)
                            {{ " " }}
                        @else
                            {{ $raffle->raffletor->name}}, {{ $raffle->insert_to}}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</body>
</html>
@endsection
