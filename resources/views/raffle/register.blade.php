@extends('layout.app2')
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
                </tr>
            </thead>
            <tbody>
                @if($raffle)
                    <tr class="text-center">
                        <td>{{ $raffle->formatted_date }}</td>
                        <td>{{ $raffle->countTickets }}</td>
                        <td>${{ number_format($raffle->subtotal, 0, ',', '.') }}</td>
                        <td>${{ number_format($raffle->willBeLucky, 0, ',', '.') }}</td>
                        <td>${{ number_format($raffle->willBeLucky + $raffle->subtotal, 0, ',', '.') }}</td>
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
                        <div class="number w-14 h-14 m-2 flex items-center justify-center border-2 cursor-pointer" data-number="{{$i}}">{{$i}}</div>
                    @endfor
                </div>
            </div>
            <div class="v-line"></div>
            <div class="grid">
                <h2>Tendré Suerte</h2>
                <br>
                <div class="numbers suerte-numbers">
                    @if($raffle->willBeLucky >= 1000)
                        @for ($i = 1; $i <= 30; $i++)
                            <div class="number w-14 h-14 m-2 flex items-center justify-center border-2 cursor-pointer" data-number="{{$i}}">{{$i}}</div>
                        @endfor
                    @endif
                </div>
            </div>
        </div>

        <div class="buttons">
            <button id="cancel" type="button" class="cancel"> Cancelar </button> 
            <button id="confirm" class="confirm">Confirmar</button>
        </div>

        <input type="hidden" id="selected_sorteo_numbers" name="selected_sorteo_numbers" value=""/>
        <input type="hidden" id="selected_suerte_numbers" name="selected_suerte_numbers" value=""/>
        <input type="hidden" id="raffle_will" value="{{ $raffle ? $raffle->willBeLucky : 0 }}"/>
    </form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let selectedSorteoNumbers = [];
        let selectedSuerteNumbers = [];

        const sorteoNumbers = document.querySelectorAll('.sorteo-numbers .number');
        const suerteNumbers = document.querySelectorAll('.suerte-numbers .number');
        const selectedSorteoNumbersInput = document.getElementById('selected_sorteo_numbers');
        const selectedSuerteNumbersInput = document.getElementById('selected_suerte_numbers');
        const raffleWill = parseInt(document.getElementById('raffle_will').value);

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

        if (raffleWill >= 1000) {
            suerteNumbers.forEach(number => {
                number.addEventListener('click', handleNumberClick(suerteNumbers, selectedSuerteNumbers, 5, selectedSuerteNumbersInput));
            });
        }

        document.getElementById('raffleForm').addEventListener('submit', (e) => {
            e.preventDefault();

            let errorMessage = '';
            if (selectedSorteoNumbers.length < 5) {
                errorMessage = 'Debe seleccionar 5 números de Sorteo.';
            }
            if (raffleWill >= 1000 && selectedSuerteNumbers.length < 5) {
                errorMessage += '\nDebe seleccionar 5 números de "Tendré Suerte".';
            }

            if (errorMessage) {
                Swal.fire({
                    title: 'Error',
                    text: errorMessage,
                    confirmButtonText: "OK",
                    customClass: {
                        confirmButton: "confirm"
                    }
                });
            } else {
                let winnerNumbers = [...selectedSorteoNumbers];
                let winnerNumbersLucky = raffleWill >= 1000 && selectedSuerteNumbers.length > 0 ? [...selectedSuerteNumbers] : null;
                if (raffleWill >= 1000 && selectedSuerteNumbers.length > 0) {
                    winnerNumbersLucky = [...selectedSuerteNumbers];
                }

                Swal.fire({
                    title: "Has seleccionado los números:",
                    html: `<h2>Sorteo</h2>
                        <p>${selectedSorteoNumbers.join("-")}</p>
                        ${raffleWill >= 1000 ? `<h2>Tendré Suerte</h2><p>${selectedSuerteNumbers.join("-")}</p>` : ''}`,
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Confirmar",
                    reverseButtons: true,
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
                                winner_numbers: winnerNumbers,
                                winner_numbers_lucky: winnerNumbersLucky,
                                raffle_id: "{{ $raffle ? $raffle->id : '' }}"
                            })
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Se ingresaron los números correctamente.",
                                    confirmButtonText: "OK",
                                    customClass: {
                                        confirmButton: "confirm",
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '{{ route("raffle.list") }}'; 
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: data.message,
                                    confirmButtonText: "OK",
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

        const cancelButton = document.getElementById('cancel');
        if (cancelButton) {
            cancelButton.addEventListener('click', () => {
                window.location.href = '{{ route("raffle.list") }}'; 
            });
        }
    });
</script>
</body>
</html>
@endsection
