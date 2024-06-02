<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Raffletor extends Authenticatable
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
        'status',
        'admin_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con los sorteos.
     */
    public function raffles()
    {
        return $this->hasMany(Raffle::class, 'raffletor_id');
    }

}

