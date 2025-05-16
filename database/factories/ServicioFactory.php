<?php

namespace Database\Factories;

use App\Models\Clinica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servicio>
 */
class ServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'clinica_id' => 1,
            'nombre' => $this->faker->randomElement([
            'Terapia manual',
            'Electroterapia',
            'Rehabilitación deportiva',
            'Masaje terapéutico',
            'Ejercicio terapéutico',
            'Terapia ocupacional',
            'Kinesiología',
            'Reeducación postural',
            'Drenaje linfático',
            'Fisioterapia respiratoria',
            'Pilates'
        ]),
            'descripcion' => $this->faker->sentence(),
            'precio' => $this->faker->randomElement([30, 45, 60, 90, 120]),
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'iva' => $this->faker->randomElement([0, 0.21]),
        ];
    }
}
