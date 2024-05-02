@extends('layout.app')

@section('content')
    {{-- Como llamar atributos pertenecientes al modelo del usuario autenticado --}}
    <h3 class="text-3xl font-bold text-center">
        Bienvenido {{ auth()->user()->isadmin }}
    </h3>

    @if (session('success'))

        <div class="bg-green-300 w-1/2 mx-auto p-2">
            <p class="text-center text-green-800 font-bold"> {{ session('success') }}</p>
        </div>

    @endif
    <div class="flex flex-col">
        

        @if ($raffletors->count() > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre producto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stock
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($raffletors as $raffletor)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $raffletor->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $raffletor->age }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $raffletor->email }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('product.edit', ['id' => $raffletor->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                <a href="{{ route('product.delete', ['id' => $raffletor->id]) }}" class="font-medium text-red-600 ml-2 dark:text-red-500 hover:underline">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <h3 class="text-2xl font-bold text-red-600 bg-slate-400 p-4 rounded-sm text-center"> No se encuentran productos en el sistema</h3>
        @endif
    </div>



@endsection