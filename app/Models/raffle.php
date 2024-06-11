<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'winner_number',
        'ticket_quantity',
        'date',
        'will_be_lucky',
        'subtotal',
        'raffletor_id',
    ];

    public function raffletor()
    {
        return $this->belongsTo(Raffletor::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}

