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
            'clinica_id' => Clinica::inRandomOrder()->first()?->id ?? 1,
            'nombre' => $this->faker->words(2, true),
            'descripcion' => $this->faker->sentence(),
            'precio' => $this->faker->randomElement([30, 45, 60, 90, 120]),
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'color' => $this->faker->randomElement(['#3b82f6', '#10b981', '#f59e0b', '#ef4444']),
            'icono' => $this->faker->randomElement([
                'fa-solid fa-calendar',
                'fa-solid fa-stethoscope',
                'fa-solid fa-user-nurse',
                'fa-solid fa-heart',
            ]),
        ];
    }
}
