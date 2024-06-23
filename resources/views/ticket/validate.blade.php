@extends('layout.app2')

@section('content')

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/styleValidate.css')
    <title>Verificador de billetes</title>
</head>

<body>
    
    <h1>Verificador de billetes</h1>
    <br>

    <div class="center-content">
        <form action="{{ route('validate_ticket') }} " >
            @csrf
            <label>Ingresa el código de tu billete</label>
            <input type="text" placeholder="Ej: 8989" name="ticket_code" id="ticket_code">
            <button class="confirm" type="submit" title="Verificar billete">Verificar</button>

            @if (session('message'))
            <p class="bg-red-500 text-white my-4 rounded-lg text-sm text-center p-2">{{ session('message') }}</p>
            @endif
    </div>
        
        @if(isset($ticket))
        <div>
            <h1>Detalles de tu Billete</h1>

            <table>
                <tr>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Fecha del Billete</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Números Jugados</th>
                </tr>
                <tr>
                    <td class="px-4 py-2 border-gray-300">{{$ticket->formatted_date}}</td>
                    <td class="px-4 py-2 border-gray-300">@foreach($ticket->content as $number)
                            <div class="circle">{{ $number }}</div>
                        @endforeach</td>
                </tr>
            </table>

            <h1>Detalles del Sorteo</h1>

            <table>
                    <tr>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Fecha del Sorteo</th>
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Números Ganadores</th>
                        @if($raffle->winner_number_lucky != 0)
                        <th class="px-4 py-2 bg-gray-200 border border-gray-300">Números Ganadores "Tendré Suerte"</th>
                        @endif
                    </tr>

                    <tr>
                        <td class="px-4 py-2 border-gray-300">{{$raffle->formatted_date}}</td>
                        
                        <td class="px-4 py-2 border-gray-300">@foreach($raffle->winner_number as $number)
                            <div class="circle">{{ $number }}</div>
                        @endforeach</td>
                        
                        @if($raffle->winner_number_lucky != 0)
                        
                            <td class="px-4 py-2 border-gray-300">@foreach($raffle->winner_number_lucky as $number)
                                <div class="circle">{{ $number }}</div>
                            @endforeach</td>
                        
                        @endif
                    </tr>
            </table>
            
            @if(
             $ticket->content == $raffle->winner_number || 
             ($ticket->content == $raffle->winner_number_lucky && $ticket->is_will_be_luck==true)
            )

                <h3>¡Tienes premio!</h3>
                <table>
                <tr>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">Sorteo principal</th>
                    <th class="px-4 py-2 bg-gray-200 border border-gray-300">"Tendré suerte"</th>
                </tr>
                <tr>
                    @if($ticket->content == $raffle->winner_number_lucky)
                        <td class="px-4 py-2 border-gray-300">${{ number_format($raffle->subtotal, 0, ',', '.') }}</td>
                        <th class="px-4 py-2 border-gray-300">${{ number_format($raffle->willBeLucky, 0, ',', '.') }}</th>
                    @elseif($ticket->content == $raffle->winner_number)
                        <th class="px-4 py-2 border-gray-300">sin premio</th>
                        <td class="px-4 py-2 border-gray-300">${{ number_format($raffle->subtotal, 0, ',', '.') }}</td>
                    @else
                        <td class="px-4 py-2 border-gray-300"></td>
                        <td class="px-4 py-2 border-gray-300"></td>
                    @endif
                </tr>
                </table>
            @else
                <h3>Sin premio</h3>
            @endif           
                    
        </div>
    
        @endif

        </form>
</body>

@endsection
</html>
