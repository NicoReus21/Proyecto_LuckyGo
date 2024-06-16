@extends('layout.app')

@section('content')
<div class="min-h-screen bg-white flex flex-col items-center justify-start pt-20 p-4">
  <div class="bg-custom-blue rounded-lg shadow-xl w-full max-w-md p-8">
    <div class="text-center mb-8">
      <img src="{{ asset('images/Luckygo.png') }}" alt="Logo de Lucky Go" class="mx-auto h-24 w-auto">
      <h2 class="text-3xl font-bold mt-4 text-white">Iniciar Sesión</h2>
    </div>
    <form method="POST" action="{{ route('login') }}" novalidate>
      @csrf
      <div class="mb-6">
        <label for="email" class="block text-white text-sm font-medium mb-2">Ingresar correo electrónico</label>
        <div class="relative">
          <input type="email" name="email" id="email" placeholder="email@email.com" class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-custom-blue bg-white text-black shadow-sm" required>
          <i class='bx bxs-envelope absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400'></i>
        </div>
        @error('email')
        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-8">
        <label for="password" class="block text-white text-sm font-medium mb-2">Ingresar contraseña</label>
        <div class="relative">
          <input type="password" name="password" id="password" placeholder="*********" class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-custom-blue bg-white text-black shadow-sm" required>
          <i class='bx bxs-lock-alt absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400'></i>
        </div>
        @error('password')
        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
        @enderror
      </div>
      <button type="submit" class="w-full bg-white text-custom-blue font-bold py-3 px-4 rounded-lg hover:bg-gray-300 transition duration-300 shadow-md">Entrar</button>

      @if (session('message'))
      <p class="bg-red-500 text-white my-4 rounded-lg text-sm text-center p-2">{{ session('message') }}</p>
      @endif
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
  .bg-custom-blue {
    background-color: #87CEEB; /* Usando un color azul cielo */
  }
  
  input:focus {
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
  }
  
  
  /* Opcional: si quieres un sombreado más suave en los inputs */
  input {
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.05);
  }
</style>
@endpush
