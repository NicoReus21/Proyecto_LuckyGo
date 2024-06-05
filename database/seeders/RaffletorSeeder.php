<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RaffletorSeeder extends Seeder
{
    /**
     * Inicialización de seeders para la tabla de raffletors.
     */
    public function run(): void
    {
        DB::table('raffletors')->insert([
            'name' => 'Kevin Sotelo',
            'email' => 'kevin.sotelo@alumnos.ucn.cl',
            'age' => '22',
            'password' => Hash::make('123456'),
            'status' => true,
            'admin_id' => 1,
        ]);

        DB::table('raffletors')->insert([
            'name' => 'Andrés Herrera',
            'email' => 'andres.herrera@alumnos.ucn.cl',
            'age' => '22',
            'password' => Hash::make('111111'),
            'status' => true,
            'admin_id' => 1,
        ]);

        DB::table('raffletors')->insert([
            'name' => 'Rubén Macaya',
            'email' => 'ruben.macaya@alumnos.ucn.cl',
            'age' => '21',
            'password' => Hash::make('313131'),
            'status' => true,
            'admin_id' => 1,
        ]);

        DB::table('raffletors')->insert([
            'name' => 'Nicolas Carmona',
            'email' => 'nicolas.carmona01@alumnos.ucn.cl',
            'age' => '22',
            'password' => Hash::make('777777'),
            'status' => true,
            'admin_id' => 1,
        ]);

        DB::table('raffletors')->insert([
            'name' => 'joseline Coronel',
            'email' => 'joseline.coronel@alumnos.ucn.cl',
            'age' => '22',
            'password' => Hash::make('987654'),
            'status' => true,
            'admin_id' => 1,
        ]);
    }
}
