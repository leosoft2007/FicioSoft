<?php

namespace Database\Seeders;

use App\Models\Clinica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinica = Clinica::create([
            'nombre' => 'Laura Beatriz Recio Jaime',
            'nif' => '49370542F',
            'direccion' => 'Av. Baronia de Polop Nº 4-5C, 03520 Polop',
            'color' => '#fd7e14',
            'email' => 'lalitabre@gmail.com',
            'telefono' => '660269438',
        ]);
        Clinica::factory(5)->create();
    }
}
