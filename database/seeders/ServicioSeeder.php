<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // crear 20 registro con id_clinica = 1
        Servicio::factory()->count(20)->create([
            'clinica_id' => 1,
        ]);
      
    }
}
