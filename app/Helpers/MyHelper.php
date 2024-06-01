<?php

function makeMessages()
{
    $messages = [
        'name_create.required' => 'debe ingresar el nombre del sorteador.',
        'name_create.min' => 'El campo nombre necesita un mínimo de 3 caracteres.',

        'age_create.required' => 'debe ingresar la edad del sorteador.',
        'age_create.numeric' => 'la edad del sorteador debe ser numérica.',
        'age_create.min' => 'la edad del sorteador no puede ser inferior a 18 y mayor a 65.',
        'age_create.max' => 'la edad del sorteador no puede ser inferior a 18 y mayor a 65.',

        'email_create.required' => 'debe ingresar el correo electrónico del sorteador.',
        'email_create.email' => 'El campo de correo electrónico debe ser una dirección de correo válida.',


        'email.required' => 'debe ingresar su correo electrónico para iniciar sesión.',
        'email.email' => 'El campo de correo electrónico debe ser una dirección de correo válida.',
        'password.required' => 'debe ingresar su contraseña para iniciar sesión.',
        'password.min' => 'El campo de contraseña debe tener al menos 5 caracteres.',

        'no_raffletors' => 'No hay sorteadores registrados en el sistema.',
    ];
    return $messages;
}
