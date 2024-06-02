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
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([AdminSeeder::class]);
        //$this->call([UserSeeder::class]);
        $this->call([RaffletorSeeder::class]);
        $this->call([RaffleSeeder::class]);
        $this->call([TicketSeeder::class]);
        

    }
}
