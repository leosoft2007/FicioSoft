<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfesionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\Profesional::factory(10)->create();
        // \App\Models\Profesional::factory()->count(10)->create();
        // \App\Models\Profesional::factory()->count(10)->create([
        //     'clinica_id' => 1,
        // ]);
        \App\Models\Profesional::factory()->count(10)->create(); 
    }
}
