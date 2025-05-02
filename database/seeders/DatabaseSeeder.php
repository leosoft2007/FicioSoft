<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClinicaSeeder::class,
            UserSeeder::class,
            HoraSeeder::class,
            PacienteSeeder::class,
            EspecialidadSeeder::class,
            

        ]);
    }
}
