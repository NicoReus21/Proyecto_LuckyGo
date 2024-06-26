<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'content',
        'is_will_be_luck',
        'raffle_id',
    ];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }
}
