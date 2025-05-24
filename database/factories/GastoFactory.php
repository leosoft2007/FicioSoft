<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gasto>
 */
class GastoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'descripcion' => $this->faker->sentence(),
            'monto' => $this->faker->randomFloat(2, 10, 1000),
            'fecha' => $this->faker->date(),
            'metodo_pago' => $this->faker->randomElement(['Efectivo', 'Tarjeta de Crédito', 'Transferencia Bancaria', 'Cheque', 'Otro']),
            'tipo_gasto_id' => \App\Models\TipoGasto::factory(),
            'user_id' => 1,
            'clinica_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
