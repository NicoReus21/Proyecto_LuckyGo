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
    public function run(): void
    {
        DB::table('tickets')->insert([
            [
                'code' => '12345',
                'date' => '2024-05-25',
                'content' => '[6,12,5,11,4]',
                'content_luck' => '',
                'is_will_be_luck' => false,
                'raffle_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('tickets')->insert([
            [
                'code' => '54321',
                'date' => '2024-05-25',
                'content' => '[1,3,8,2,9]',
                'content_luck' => '[1,3,8,2,9]',
                'is_will_be_luck' => true,
                'raffle_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('tickets')->insert([
            [
                'code' => '67584',
                'date' => '2024-05-25',
                'content' => '[9,12,5,1,4]',
                'content_luck' => ' ',
                'is_will_be_luck' => false,
                'raffle_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('tickets')->insert([
            [
                'code' => '22222',
                'date' => '2024-05-25',
                'content' => '[9,10,2,1,4]',
                'content_luck' => '[9,10,2,1,4]',
                'is_will_be_luck' => true,
                'raffle_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


