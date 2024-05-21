<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users') -> insert(
            [
                'name' => 'Antonio Barraza Guzman',
                'email' => 'antonio.barraza.guzman@gmail.com',
                'password' => Hash::make('Luckygo23'),
            ]
        );
    }
}
