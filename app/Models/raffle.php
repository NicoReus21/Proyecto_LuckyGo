<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;

    /**
     * Atributos de un raffle agregados en masa.
     * 
     * @var array
     */
    protected $fillable = [
        'status',
        'winner_number',
        'ticket_quantity',
        'date',
        'will_be_lucky',
        'subtotal',
        'raffletor_id'
    ];

    /**
     * Relación con sorteadores.
     */
    public function raffletor()
    {
        return $this->belongsTo(Raffletor::class);
    }
}
