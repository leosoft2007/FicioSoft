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
        ]);
        $especialidad = Especialidad::create([
            'nombre' => 'Psicologia',
            'descripcion' => 'psicologia',
        ]);
        $especialidad = Especialidad::create([
            'nombre' => 'Nutricion',
            'descripcion' => 'nutricion',
        ]);
        $especialidad = Especialidad::create([
            'nombre' => 'Pilates',
            'descripcion' => 'pilates',
        ]);
    }
}
