<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReciboSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // creamos 20 recibos
        \App\Models\Recibo::factory()->count(20)->create([
            'clinica_id' => 1, // Asignamos la clínica por defecto
        ]);
    }
}
