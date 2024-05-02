<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Raffletor
 * 
 * Modelo para representar los sorteadores en la base de datos.
 */
class Raffletor extends Model
{
    use HasFactory;

    /**
     * Atributos de un sorteador agregados en masa.
     */
    protected $fillable = [
        'name',
        'email',
        'age',
        'password',
    ];
}
