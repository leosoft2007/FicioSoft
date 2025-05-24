<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoGasto>
 */
class TipoGastoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // generar nombre único para cada tipo de gasto


            'nombre' => $this->faker->unique()->bothify('TipoGasto-###??'),
            'descripcion' => $this->faker->sentence(),
            'clinica_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
