@extends('layout.app')
@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <div class="numbers sorteo-numbers">
                @for ($i = 1; $i <= 30; $i++)
                    <div class="number inline-block w-14 h-14 m-2 text-center border-2 cursor-pointer" data-number="{{$i}}">{{$i}}</div>
                @endfor
            </div>
        </div>
        <div class="v-line"></div>
        <div class="grid">
            <h2>Tendré Suerte</h2>
            <div class="numbers suerte-numbers">
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
    <input type="hidden" id="selected_sorteo_numbers" name="selected_sorteo_numbers" value=""/>
    <input type="hidden" id="selected_suerte_numbers" name="selected_suerte_numbers" value=""/>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let selectedSorteoNumbers = [];
            let selectedSuerteNumbers = [];
            const sorteoNumbers = document.querySelectorAll('.sorteo-numbers .number');
            const suerteNumbers = document.querySelectorAll('.suerte-numbers .number');
            const selectedSorteoNumbersInput = document.getElementById('selected_sorteo_numbers');
            const selectedSuerteNumbersInput = document.getElementById('selected_suerte_numbers');

            function handleNumberClick(numbers, selectedNumbers, maxSelection, input) {
                return (event) => {
                    const number = event.target;
                    const num = parseInt(number.getAttribute('data-number'));

                    if (selectedNumbers.includes(num)) {
                        selectedNumbers = selectedNumbers.filter(n => n !== num);
                        number.classList.remove('bg-red-300');
                    } else if (selectedNumbers.length < maxSelection) {
                        selectedNumbers.push(num);
                        number.classList.add('bg-green-300');
                    }

                    input.value = JSON.stringify(selectedNumbers);
                };
            }

            sorteoNumbers.forEach(number => {
                number.addEventListener('click', handleNumberClick(sorteoNumbers, selectedSorteoNumbers, 5, selectedSorteoNumbersInput));
            });

            suerteNumbers.forEach(number => {
                number.addEventListener('click', handleNumberClick(suerteNumbers, selectedSuerteNumbers, 5, selectedSuerteNumbersInput));
            });
        });
    </script>
</body>
</html>

@endsection
