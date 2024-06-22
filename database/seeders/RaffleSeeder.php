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
    public function run(): void
    {
        DB::table('raffles')->insert([
            [
                'status' => 1,
                'winner_number' => '[9,11,7,1,4]',
                'winner_number_lucky' => '[9,10,2,1,4]',
                'ticket_quantity' => 10,
                'date' => '2024-06-02',
                'end_date' => '2024-06-23',
                'will_be_lucky' => 3000, // total recaudado en billetes tendre suerte
                'subtotal' => 18000, // total recaudado en billetes normales
                'raffletor_id' => 1,
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);

        DB::table('raffles')->insert([
            [
                'status' => 1,
                'winner_number' => '[1,3,8,2,9]',
                'winner_number_lucky' => '[9,12,5,1,4]',
                'ticket_quantity' => 10,
                'date' => '2024-06-02',
                'end_date' => '2024-06-23',
                'will_be_lucky' => 3000, // total recaudado en billetes tendre suerte
                'subtotal' => 18000, // total recaudado en billetes normales
                'raffletor_id' => 1,
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);

        DB::table('raffles')->insert([
            [
                'status' => 1,
                'winner_number' => '[1,3,8,2,9]',
                'winner_number_lucky' => '',
                'ticket_quantity' => 10,
                'date' => '2024-06-02',
                'end_date' => '2024-06-23',
                'will_be_lucky' => 0, // total recaudado en billetes tendre suerte
                'subtotal' => 18000, // total recaudado en billetes normales
                'raffletor_id' => 1,
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);
    }
}
