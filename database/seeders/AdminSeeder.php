<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Inicialización de seeders para la tabla de admins.
     */
    public function run(): void
    {
        DB::table('admins') -> insert(
            [
                'name' => 'Antonio Barraza Guzman',
                'email' => 'antonio.barraza.guzman@gmail.com',
                'password' => Hash::make('Luckygo23'),
            ]
        );
    }
}
