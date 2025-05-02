<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinica>
 */
class ClinicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Definimos los datos por defecto para la clinica
            'nombre' => $this->faker->name(),
            'color' => $this->faker->hexColor(),
            'nif' => $this->faker->unique()->word(),
            'direccion' => $this->faker->address(),
            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'imagen' => $this->faker->imageUrl(640, 480, 'business', true, 'clinica', true),
                
    
        ];
    }
}
