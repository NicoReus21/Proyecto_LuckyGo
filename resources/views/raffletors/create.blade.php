@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Sorteador</title>
</head>

<body>
    <section style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="background-color: #c2cbc8; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); max-width: 400px; width: 100%;">
            <h1 style="font-size: 36px; font-weight: bold; margin-bottom: 20px; text-align: center;">Registrar Sorteador</h1>
            <form method="POST" action="{{ route('raffletors.store')}}" style="display: flex; flex-wrap: wrap;" novalidate>
                @csrf
                <div style="flex: 1; margin-right: 10px; margin-bottom: 16px;">
                    <label for="name" style="display: block; font-size: 16px; margin-bottom: 6px;">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Ingrese su nombre" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('name')
                            <p style="color: #f56558;">{{ $message }}</p>
                    @enderror
                </div>
                <div style="flex: 1; margin-bottom: 16px;">
                    <label for="age" style="display: block; font-size: 16px; margin-bottom: 6px;">Edad</label>
                    <input type="text" name="age" id="age" placeholder="18" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('age')
                            <p style="color: #f56558;">{{ $message }}</p>
                    @enderror
                </div>
                <div style="width: 100%; margin-bottom: 16px;">
                    <label for="email" style="display: block; font-size: 16px; margin-bottom: 6px;">Correo</label>
                    <input type="email" name="email" id="email" placeholder="email@email.com" required="" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('email')
                            <p style="color: #f56558;">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" style="width: 100%; padding: 12px 0; background-color: #0F79BB; color: white; font-size: 16px; font-weight: bold; border: none; border-radius: 4px; cursor: pointer;">Registrar</button>
            </form>
        </div>
    </section>
</body>

</html>
@endsection