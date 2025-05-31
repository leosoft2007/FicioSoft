<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recibo>
 */
class ReciboFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'valor' => $this->faker->randomFloat(2, 10, 1000),
            'observacion' => $this->faker->sentence,
            'numero' => $this->faker->unique()->numerify('REC-#####'),
            'formadepago' => $this->faker->randomElement(['efectivo', 'tarjeta', 'transferencia', 'bizum']),
            'user_id' => 1,
            // Obtener un id de paciente aleatorio existente, o crear uno si no hay
            'paciente_id' => \App\Models\Paciente::query()->inRandomOrder()->value('id') ?? \App\Models\Paciente::factory(),
        ];
    }
}
