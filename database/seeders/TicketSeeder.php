<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TicketSeeder extends Seeder
{
    /**
     * Inicialización de seeders para la tabla de tickets.
     */
    public function run()
    {
        DB::table('tickets')->insert([
            [
                'date' => '2024-05-25',
                'content' => 98765,
                'is_will_be_luck' => false,
                'raffle_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2024-05-24',
                'content' => 12345,
                'is_will_be_luck' => false,
                'raffle_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2024-04-23',
                'content' => 12345,
                'is_will_be_luck' => false,
                'raffle_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


