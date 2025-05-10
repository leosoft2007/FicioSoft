<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especialidad = Especialidad::create([
            'nombre' => 'ficioterapia',
            'descripcion' => 'fisioterapia',
            'clinica_id' => 1,
        ]);
        $especialidad = Especialidad::create([
            'nombre' => 'Psicologia',
            'descripcion' => 'psicologia',
            'clinica_id' => 1,
        ]);
        $especialidad = Especialidad::create([
            'nombre' => 'Nutricion',
            'descripcion' => 'nutricion',
            'clinica_id' => 1,
        ]);
        $especialidad = Especialidad::create([
            'nombre' => 'Pilates',
            'descripcion' => 'pilates',
            'clinica_id' => 1,
        ]);
    }
}
