@extends('layout.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite("resources/css/styleLogin.css")
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Iniciar Sesión</title>
</head>
<body>
    
    <div class="wrapper">   
    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf 
        <div class="logo-container">
            <img src="{{ asset('images/Luckygo.png') }}" alt="Logo de Lucky Go" class="logo">
        </div>
             
        <h1>Iniciar Sesión</h1>
        <div class="input-box">

            <label for="email">Ingresar correo electrónico</label>
            <input type="text" name="email" placeholder="email@email.com" required="">
            <i class='bx bxs-envelope' ></i>

            @error('email')
            <p style="color: #f56558;">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box">

        <label for="passwordLogin">Ingresar contraseña</label>
            <input type="password" name="password" placeholder="*********" required="">
            <i class='bx bxs-lock-alt'></i>

            @error('password')
            <p style="color: #f56558;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn">Entrar</button>

        @if (session('message'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ session('message') }}</p>
        @endif
    </form>
    </div>
</body>
</html>
@endsection