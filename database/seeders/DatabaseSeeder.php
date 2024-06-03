<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Raffletor;
use App\Models\admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Aplicación de seeders en la base de datos.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([AdminSeeder::class]);
        $this->call([RaffletorSeeder::class]);
        $this->call([RaffleSeeder::class]);
        $this->call([TicketSeeder::class]);
        

    }
}
