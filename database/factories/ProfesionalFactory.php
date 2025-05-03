<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profesional>
 */
class ProfesionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      //especialidad aleatoria de la tabla especialidad
      //clinica aleatoria de la tabla clinica
      //usuario aleatorio de la tabla user
      $especialidad = \App\Models\Especialidad::inRandomOrder()->first();
        $clinica = \App\Models\Clinica::inRandomOrder()->first();
        $usuario = \App\Models\User::inRandomOrder()->first();
        return [
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->lastName(),
            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'cif' => $this->faker->unique()->numerify('#########'),
            'especialidad_id' => $especialidad,
            'clinica_id' => $clinica,
            'direccion' => $this->faker->address(),
            'ciudad' => $this->faker->city(),
            'estado' => $this->faker->state(),
            'codigo_postal' => $this->faker->postcode(),
            'usuario_id' => $usuario,
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
        ];
    }
}
