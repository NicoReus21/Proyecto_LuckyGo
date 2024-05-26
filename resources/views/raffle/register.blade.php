@extends('layout.app')
@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite("resources/css/styleRegister.css")
    <title>Registrar Sorteo</title>
</head>
<body>
    <br>
    <h1>Registrar Sorteo</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha del sorteo</th>
                <th>Cantidad de billetes</th>
                <th>Subtotal de billetes</th>
                <th>"Tendré Suerte"</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Ingresado por</th>
            </tr>
        </thead>
    </table>
    
    <div class="grids">
        <div class="grid">
            <h2>Sorteo</h2>
            <br>
            <div class="numbers">
                @for ($i = 1; $i <= 30; $i++)
                    <div class="number inline-block w-14 h-14 m-2 text-center border-2 cursor-pointer" data-number="{{$i}}">{{$i}}</div>
                @endfor
            </div>
        </div>
        <div class="v-line"></div>
        <div class="grid">
            <h2>Tendré Suerte</h2>
            <div class="numbers">
                @for ($i = 1; $i <= 30; $i++)
                    <div class="number inline-block w-14 h-14 m-2 text-center border-2 cursor-pointer" data-number="{{$i}}">{{$i}}</div>
                @endfor
            </div>
        </div>
    </div>

   <div class="buttons">
        <button class="confirm">Confirmar</button>
        <button class="cancel">Cancelar</button>
    </div>
    <input type="hidden" id="selected_numbers" name="selected_numbers" value=""/>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let selectedNumbers = [];
            const numbers = document.querySelectorAll('.number');
            const selectedNumbersInput = document.getElementById('selected_numbers');

            numbers.forEach(number => {
                number.addEventListener('click', () => {
                    const num = parseInt(number.getAttribute('data-number'));
                    
                    if (selectedNumbers.includes(num)) {
                        selectedNumbers = selectedNumbers.filter(n => n !== num);
                        number.classList.remove('bg-red-300');
                    } else if (selectedNumbers.length < 10) {
                        selectedNumbers.push(num);
                        number.classList.add('bg-red-300');
                    }

                    selectedNumbersInput.value = JSON.stringify(selectedNumbers);
                });
            });
        });
    </script>
</body>
</html>

@endsection
