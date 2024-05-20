<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Raffletor extends Model implements Authenticatable
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

    // Métodos de la interfaz Authenticatable

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthPasswordName()
    {
        return 'password';
    }

    public function getRememberTokenName()
    {
        return null; // o devuelve el nombre de la columna donde almacenas el token de recuerdo
    }

    public function setRememberToken($value)
    {
        // puedes implementarlo si usas el token de recuerdo
    }

    public function getRememberToken()
    {
        // puedes implementarlo si usas el token de recuerdo
    }
}

