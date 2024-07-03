<?php

function makeMessages()
{
    $messages = [
        'name.required' => 'Debe ingresar el nombre del usuario.',
        'name.min' => 'El campo nombre necesita un mínimo de 3 caracteres.',
        
        'age.required' => 'Debe ingresar la edad del usuario.',
        'age.numeric' => 'La edad del usuario debe ser numérica.',
        'age.min' => 'La edad del usuario no puede ser inferior a 18 años.',
        'age.max' => 'La edad del usuario no puede ser superior a 65 años.',
        
        'email.required' => 'Debe ingresar su correo electrónico.',
        'email.email' => 'El campo de correo electrónico debe ser una dirección de correo válida.',
        'email.unique' => 'El correo electrónico ya está registrado.',
        
        'password.required' => 'Debe ingresar su contraseña.',
        'password.min' => 'El campo de contraseña debe tener al menos 5 caracteres.',
        'password_confirmation.same' => 'Las contraseñas no coinciden.',
        'password.regex' => 'La contraseña no debe comenzar por 0.',
        'password.numeric' => 'La contraseña deben ser solamente números.',

        'name_create.required' => 'Debe ingresar el nombre del sorteador.',
        'name_create.min' => 'El campo nombre necesita un mínimo de 3 caracteres.',
        
        'age_create.required' => 'Debe ingresar la edad del sorteador.',
        'age_create.numeric' => 'La edad del sorteador debe ser numérica.',
        'age_create.min' => 'La edad del sorteador no puede ser inferior a 18 años.',
        'age_create.max' => 'La edad del sorteador no puede ser superior a 65 años.',
        
        'email_create.required' => 'Debe ingresar el correo electrónico del sorteador.',
        'email_create.email' => 'El campo de correo electrónico debe ser una dirección de correo válida.',
        
        'no_connection' => 'Se necesita conexión a internet para el registro de un nuevo sorteador.',
        'no_raffletors' => 'No hay sorteadores registrados en el sistema.',
        'no_raffles' => 'No hay sorteos registrados en el sistema.',
    ];

    return $messages;
}
