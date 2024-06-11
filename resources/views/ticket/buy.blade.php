@extends('layout.app2')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Billetes de Lotería</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .number-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 5px;
            background-color: #f0f0f0;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 1.25rem;
        }
        .number-button.selected {
            background-color: #2ECC71; 
            color: white;
        }
        .message {
            background-color: #FFD700; 
            color: black;
            padding: 10px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .error-message {
            color: #f56558; 
            margin-top: 5px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8 mt-12">
        <p class="text-xl text-center mb-4">Seleccione 5 números del 1 al 30</p>
        
        <form id="lotteryForm" method="POST" action="{{ route('ticket.buy') }}" class="max-w-xl mx-auto p-6 bg-white shadow-md rounded">
            @csrf
            <h2 class="text-2xl mb-4">Compra de billetes de lotería</h2>
            
            <div id="numbers" class="grid grid-cols-6 gap-4 justify-center mb-4">
                @for ($i = 1; $i <= 30; $i++)
                <div class="number-button border-2 border-gray-300" data-number="{{ $i }}">
                    {{ $i }}
                </div>
                @endfor
            </div>
            
            <input type="hidden" name="numbers[]" id="selectedNumbersInput">
            
            <p class="mt-4">Billete: $2.000</p>
            <label class="block mt-2">
                <input type="checkbox" name="category" id="category" value="1" class="mt-2"/>
                Categoría "Tendré Suerte" (+$1.000)
            </label>
            
            <p class="mt-4 font-bold">Total: <span id="total">$2.000</span></p>

            <div class="message mt-4">
                <p>Para participar en el sorteo de cada domingo, asegúrate de realizar la compra de tus billetes antes de las 23:59 horas de ese mismo día. Todas las compras efectuadas dentro de este plazo serán incluidas en el sorteo correspondiente.</p>
            </div>

            <div id="errorMessage" class="error-message"></div>

            <button type="button" id="buyButton" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Comprar</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const numberButtons = document.querySelectorAll('.number-button');
            const categoryCheckbox = document.getElementById('category');
            const totalElement = document.getElementById('total');
            const selectedNumbersInput = document.getElementById('selectedNumbersInput');
            let selectedNumbers = [];
            const basePrice = 2000;
            const extraPrice = 1000;

            numberButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const number = parseInt(button.dataset.number);
                    
                    if (selectedNumbers.includes(number)) {
                        selectedNumbers = selectedNumbers.filter(num => num !== number);
                        button.classList.remove('selected');
                    } else {
                        if (selectedNumbers.length < 5) {
                            selectedNumbers.push(number);
                            button.classList.add('selected');
                        }
                    }
                    selectedNumbersInput.value = JSON.stringify(selectedNumbers);
                    updateTotal();
                });
            });

            categoryCheckbox.addEventListener('change', function () {
                updateTotal();
            });

            function updateTotal() {
                let total = basePrice;
                if (categoryCheckbox.checked) {
                    total += extraPrice;
                }
                totalElement.textContent = `$${total.toLocaleString()}`;
            }

            const buyButton = document.getElementById('buyButton');
            buyButton.addEventListener('click', function () {
                if (selectedNumbers.length !== 5) {
                    document.getElementById('errorMessage').textContent = 'Debe seleccionar exactamente 5 números';
                    return;
                }

                document.getElementById('errorMessage').textContent = '';

                const selectedNumbersText = selectedNumbers.join('-');
                const totalPrice = totalElement.textContent;
                
                Swal.fire({
                    title: 'Ha seleccionado los números:',
                    html: `
                        <p>${selectedNumbersText}</p>
                        <p>El valor total de tu billete es <strong>${totalPrice}</strong></p>
                        <p><strong>¿Desea continuar?</strong></p>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2ECC71', 
                    cancelButtonColor: '#F6686B', 
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: '¡Compra realizada con éxito!',
                            html: `
                                <p style="text-align: left;">Tu número de billete es <strong>(Número de ejemplo)</strong></p> 
                                <p style="text-align: left;">Fecha <strong>(Fecha de ejemplo)</strong></p> 
                                <p style="margin-top: 10px; text-align: left; color: #2ECC71;">Juega con responsabilidad en LuckyGO</p> 
                            `,
                            icon: 'success',
                            confirmButtonColor: '#2ECC71', 
                            confirmButtonText: 'OK',
                        });
                        document.getElementById('lotteryForm').submit();
                    }
                });
            });
        });
    </script>
</body>
</html>

@endsection
