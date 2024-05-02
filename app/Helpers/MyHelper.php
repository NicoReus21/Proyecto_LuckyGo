<?php

function makeMessages()
{
    $messages = [
        'name.required' => 'debe ingresar el nombre del sorteador.',
        'name.min' => 'El campo nombre necesita un minimo de 3 caracteres.',

        'age.required' => 'debe ingresar la edad del sorteador.',
        'age.numeric' => 'la edad del sorteador debe ser numérica.',
        'age.min' => 'la edad del sorteador no puede ser inferior a 18 y mayor a 65.',
        'age.max' => 'la edad del sorteador no puede ser inferior a 18 y mayor a 65.',

        'emailCreate.required' => 'debe ingresar el correo electrónico del sorteador.',
        'emailCreate.email' => 'El campo de correo electrónico debe ser una dirección de correo válida.',


        'emailLogin.required' => 'debe ingresar su correo para iniciar sesión.',
        'emailLogin.email' => 'El campo de correo electrónico debe ser una dirección de correo válida.',
        'passwordLogin.required' => 'debe ingresar su contraseña para iniciar sesión.',
        'passwordLogin.min' => 'El campo de contraseña debe tener al menos 5 caracteres.',


    ];

    return $messages;
}
