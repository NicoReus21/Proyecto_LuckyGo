<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Raffletor extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'age',
        'password',
        'status',
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

    public function raffles()
    {
        return $this->hasMany(Raffle::class, 'raffletor_id');
    }
}
