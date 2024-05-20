@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Sorteador</title>
    <style>
        .field-row {
            display: flex;
            margin-bottom: 10px;
        }

        .field-container {
            flex: 1;
            margin-right: 10px;
        }

        .field-container label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .field-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .field-container .error-message {
            color: #f56558;
            margin-top: 5px;
        }

        #name {
            width: 400px;
            align-self: flex-end;
        }

        #age {
            width: 140px;
            align-self: flex-end;
        }

        button[type="submit"] {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <section style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="background-color: #c2c2c2; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); max-width: 600px; width: 100%;">
            <h1 style="font-size: 36px; font-weight: bold; margin-bottom: 20px; text-align: center;">Registrar Sorteador</h1>
            <form method="POST" action="{{ route('raffletors.store') }}" novalidate>
                @csrf
                <div class="field-row">
                    <div class="field-container">
                        <label for="name">Nombre</label>
                        <input type="text" name="name_create" id="name" placeholder="Ingrese el nombre del sorteador">
                        @error('name_create')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field-container">
                        <label for="age">Edad</label>
                        <input type="text" name="age_create" id="age" placeholder="18" maxlength="8">
                        @error('age_create')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="field-container">
                    <label for="email">Correo</label>
                    <input type="email" name="email_create" id="email" placeholder="email@email.com" required>
                    @error('email_create')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" style="width: 100%; padding: 12px 0; background-color: #0F79BB; color: white; font-size: 16px; font-weight: bold; border: none; border-radius: 4px; cursor: pointer;">Registrar</button>
            </form>
        </div>
    </section>
</body>
</html>
@endsection