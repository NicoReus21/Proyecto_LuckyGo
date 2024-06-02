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
    <form id="raffleForm" action="{{ route('raffle.updateWinner') }}" method="POST" class="body">
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
            <tbody>
                @if($raffle)
                    <tr>
                        <td>{{ $raffle->date }}</td>
                        <td>{{ $raffle->ticket_quantity }}</td>
                        <td>{{ $raffle->subtotal }}</td>
                        <td>{{ $raffle->will_be_lucky }}</td>
                        <td>{{ $raffle->ticket_quantity * $raffle->subtotal }}</td>
                        <td>{{ $raffle->status ? 'Activo' : 'Inactivo' }}</td>
                        <td>{{ $raffle->rafflertor_id }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="7">No hay sorteos registrados.</td>
                    </tr>
                @endif
            </tbody>
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
            <button id="cancel" type="button" class="cancel"> Cancelar </button> 
            <button id="confirm" class="confirm">Confirmar</button>
        </div>

        <input type="hidden" id="selected_sorteo_numbers" name="selected_sorteo_numbers" value=""/>
        <input type="hidden" id="selected_suerte_numbers" name="selected_suerte_numbers" value=""/>
        <input type="hidden" name="raffle_id" value="{{ $raffle->id }}"/>
    </form>

    <!-- Asegúrate de tener SweetAlert2 y jQuery incluidos en tu vista -->
<!-- Ejemplo: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let selectedSorteoNumbers = [];
        let selectedSuerteNumbers = [];

        const sorteoNumbers = document.querySelectorAll('.sorteo-numbers .number');
        const selectedSorteoNumbersInput = document.getElementById('selected_sorteo_numbers');

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

        document.getElementById('raffleForm').addEventListener('submit', (e) => {
            e.preventDefault();

            if (selectedSorteoNumbers.length < 5) {
                Swal.fire({
                    title: 'Error',
                    text: 'Debe seleccionar 5 números',
                    confirmButtonText: "ok",
                    customClass: {
                        confirmButton: "confirm"
                    }
                });
            } else {
                Swal.fire({
                    title: "Has seleccionado los números:",
                    html: `<h2>Sorteo</h2>
                           <p>${selectedSorteoNumbers.join("-")}</p>`,
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Confirmar",
                    customClass: {
                        confirmButton: "confirm",
                        cancelButton: "cancel"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ route('raffle.updateWinner') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                winner_numbers: selectedSorteoNumbers,
                                raffle_id: "{{ $raffle->id }}"
                            })   
                        }).then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.href = "{{ route('registerForm') }}";
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: data.message,
                                        confirmButtonText: "ok",
                                        customClass: {
                                            confirmButton: "confirm"
                                        }
                                    });
                                }
                            });
                    }
                });
            }
        });

        // Asegurarse de que el botón con id 'cancel' exista en el HTML
        const cancelButton = document.getElementById('cancel');
        if (cancelButton) {
            cancelButton.addEventListener('click', () => {
                window.location.href = '{{ route("raffle.list") }}'; // Redirige a la ruta 'raffle.list'
            });
        }
    });
    
</script>
</body>
</html>
@endsection
