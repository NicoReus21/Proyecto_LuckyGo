<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RaffleSeeder extends Seeder
{
    /**
     * Inicialización de seeders para la tabla de raffles.
     */
    public function run()
    {
        DB::table('raffles')->insert([
            [
                'status' => 1,
                'winner_number' => " ",
                'ticket_quantity' => 10,
                'date' => '2024-06-02',
                'will_be_lucky' => 3000, // total recaudado en billetes tendre suerte
                'subtotal' => 18000, // total recaudado en billetes normales
                'raffletor_id' => null,
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);
    }
}
