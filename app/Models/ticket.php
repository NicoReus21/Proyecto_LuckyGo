<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'date',
        'content',
        'content_luck',
        'is_will_be_luck',
        'raffle_id',
        //'ticket_numbers', // Asegúrate de que este campo existe en tu tabla
    ];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }
}
