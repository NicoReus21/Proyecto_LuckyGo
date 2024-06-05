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

        DB::table('raffles')->insert([
        
            [
                'status' => 1,
                'winner_number' => " ",
                'ticket_quantity' => 4,
                'date' => '2024-06-02',
                'will_be_lucky' => 0,
                'subtotal' => 8000,
                'raffletor_id' => null,
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);

        DB::table('raffles')->insert([
        
            [
                'status' => 2,
                'winner_number' => "[6,12,5,11,4]",
                'ticket_quantity' => 1,
                'date' => '2024-04-28',
                'will_be_lucky' => 3000,
                'subtotal' => 0,
                'raffletor_id' => 2,
                'created_at' => now(),
                'updated_at' => "2024-04-28 12:35:59",
            ],
        ]);

        DB::table('raffles')->insert([
        
            [
                'status' => 3,
                'winner_number' => " ",
                'ticket_quantity' => 3,
                'date' => '2024-06-09',
                'will_be_lucky' => 0,
                'subtotal' => 6000,
                'raffletor_id' => null,
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);

    }
}
