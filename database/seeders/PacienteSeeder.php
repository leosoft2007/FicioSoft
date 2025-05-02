<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\Paciente::factory(10)->create();
        // \App\Models\Paciente::factory()->count(10)->create();
        // \App\Models\Paciente::factory()->count(10)->create([
        //     'clinica_id' => 1,
        // ]);
        \App\Models\Paciente::factory()->count(20)->create([
            'clinica_id' => 1,
        ]);
    }
}
