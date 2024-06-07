<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_1',
        'number_2',
        'number_3',
        'number_4',
        'number_5',
        'ticket_number'
    ];
}
