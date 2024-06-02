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
            // Cambiar para que reciva los datos de las tablas equisdedelol

/* 
                @foreach($sorteos as $sorteo)
                <tr>
                    <td class="px-4 py-2 border border-gray-300">{{ $sorteo->fecha }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $sorteo->cantidad_billetes }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $sorteo->subtotal_billetes }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $sorteo->tendre_suerte }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $sorteo->total }}</td>
                    <td class="px-4 py-2 border border-gray-300">
                        @if($sorteo->estado == "No realizado")
                            No realizado 
                            <button class="bg-green-500 text-white px-2 py-1 rounded-md hover:bg-green-700 ml-2">Ingresar</button>
                        @else
                            {{ $sorteo->estado }}
                        @endif
                    </td>
                    <td class="px-4 py-2 border border-gray-300">{{ $sorteo->ingresado_por }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</body>
</html>
@endsection
