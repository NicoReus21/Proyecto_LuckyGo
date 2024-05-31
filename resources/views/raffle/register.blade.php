@extends('layout.app')
@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite("resources/css/styleRegister.css")
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <title>Registrar Sorteo</title>
</head>
<body class="body">
    <form id="raffleForm" action="{{ route('raffle.play') }}" method="POST" class="body">
        @csrf
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
            <button type="submit" class="confirm">Confirmar</button>
            <button type="submit" class="cancel">Cancelar</button>
        </div>

        <input type="hidden" id="selected_sorteo_numbers" name="selected_sorteo_numbers" value=""/>
        <input type="hidden" id="selected_suerte_numbers" name="selected_suerte_numbers" value=""/>

    </form>

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

                const index = selectedNumbers.indexOf(num);
                if (index > -1) {
                selectedNumbers.splice(index, 1);
                number.classList.remove('bg-green-300');

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

        document.getElementById('raffleForm').addEventListener('submit', (e) => {
            e.preventDefault();

            if (selectedSorteoNumbers.length < 5 || selectedSuerteNumbers.length < 5 ) {
                Swal.fire({
                    title: 'Error',
                    text: 'Debe seleccionar 5 números',
                    showConfirmButton: true,
                    confirmButtonText: "ok",
                    customClass: {
                        confirmButton: "confirm"
                    }
                });
            } else {
                Swal.fire({
                    title: "Has seleccionado los números",
                    text: 'números sorteo:',
                    html: `<p>${selectedSorteoNumbers.join("-")}</p>`,
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Confirmar",
                    customClass: {
                        confirmButton: "confirm",
                        cancelButton: "cancel"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit();
                    }
                });
            }
        });
        })    

    </script>

</body>
</html>

@endsection
