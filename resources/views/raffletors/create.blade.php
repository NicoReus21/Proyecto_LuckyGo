@extends('layout.app2')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Registrar Sorteador</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .custom-button {
            width: 48%;
            padding: 12px 0;
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-100">
    <section style="display: flex; justify-content: center; align-items: center; height: calc(100vh - 5rem);">
        <div class="bg-blue-500 p-8 rounded-md shadow-md max-w-3xl w-full">
            <h1 class="text-3xl font-bold mb-6 text-center text-white">Registrar Sorteador</h1>

            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form id="raffletorsForm" method="POST" action="{{ route('raffletors.store') }}" novalidate>
                @csrf
                <div class="flex mb-4">
                    <div class="w-2/3 mr-4">
                        <label for="name" class="block text-white">Nombre</label>
                        <input type="text" name="name_create" id="name" placeholder="Ingrese el nombre del sorteador" value="{{ old('name_create') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                        @error('name_create')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-1/3">
                        <label for="age" class="block text-white">Edad</label>
                        <input type="text" name="age_create" id="age" placeholder="18" maxlength="2" value="{{ old('age_create') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                        @error('age_create')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-white">Correo</label>
                    <input type="email" name="email_create" id="email" placeholder="email@email.com" value="{{ old('email_create') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    @error('email_create')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-between mt-4">
                    <a href="{{ route('raffletors.manage') }}" class="bg-gray-500 text-white custom-button rounded-md hover:bg-gray-700 transition">Volver</a>
                    <button id="confirm" type="submit" class="bg-white text-blue-500 custom-button rounded-md hover:bg-blue-200 transition">Registrar</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.getElementById('confirm').addEventListener('click', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: "¿Desea confirmar?",
                showCancelButton: true,
                reverseButtons: true,
                cancelButtonText: "Cancelar",
                confirmButtonText: "Confirmar",
                confirmButtonColor: '#2ECC71',
                cancelButtonColor: '#F6686B',
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('raffletorsForm').submit();
                }
            });
        });
    </script>

</body>
</html>
@endsection

