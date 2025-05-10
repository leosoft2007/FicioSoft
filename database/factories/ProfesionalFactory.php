<?php

namespace Database\Factories;

use App\Models\Especialidad;
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
      $especialidad = Especialidad::withoutGlobalScopes()->inRandomOrder()->first();
      //  $clinica = \App\Models\Clinica::inRandomOrder()->first();
      //  $usuario = \App\Models\User::inRandomOrder()->first();
        return [
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->lastName(),
            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'cif' => $this->faker->unique()->numerify('#########'),
            'especialidad_id' => $especialidad?->id, // <-- importante
            'clinica_id' => 1,
            'direccion' => $this->faker->address(),
            'ciudad' => $this->faker->city(),
            'estado' => $this->faker->state(),
            'codigo_postal' => $this->faker->postcode(),
            'usuario_id' => 1,
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'color' => $this->faker->randomElement([
                '#FF6B6B', // rojo vivo
                '#FF9F40', // naranja fuerte
                '#FFEB3B', // amarillo brillante
                '#4CAF50', // verde intenso
                '#42A5F5', // azul brillante
                '#AB47BC', // morado fuerte
                '#FF8A65', // coral oscuro
                '#9575CD', // lavanda saturada
                '#B388FF', // violeta más vivo
                '#4DD0E1'  // turquesa fuerte
            ])
        ];
    }
}
