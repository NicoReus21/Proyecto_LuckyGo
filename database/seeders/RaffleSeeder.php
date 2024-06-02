<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RaffleSeeder extends Seeder
{
   
    public function run()
    {
        DB::table('raffles')->insert([
        
            [
                'status' => true,
                'winner_number' => 0,
                'ticket_quantity' => 100,
                'date' => '2024-05-24',
                'will_be_lucky' => 10,
                'subtotal' => 500,
                'raffletor_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}

