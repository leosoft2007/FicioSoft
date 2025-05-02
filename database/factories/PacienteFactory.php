<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'fecha_nacimiento' => $this->faker->date(),
            'direccion' => $this->faker->address(),
            'ciudad' => $this->faker->city(),
            'estado' => $this->faker->state(),
            'codigo_postal' => $this->faker->postcode(),
            'pais' => $this->faker->country(),
            'genero' => $this->faker->randomElement(['masculino', 'femenino']),
            'estado_civil' => $this->faker->randomElement(['soltero', 'casado', 'divorciado', 'viudo']),
            'ocupacion' => $this->faker->jobTitle(),
            'nacionalidad' => $this->faker->country(),
            'tipo_documento' => $this->faker->randomElement(['DNI', 'Pasaporte', 'Tarjeta de residencia']),
            'numero_documento' => $this->faker->unique()->numerify('#########'),
            'telefono_emergencia' => $this->faker->phoneNumber(),
            'nombre_contacto_emergencia' => $this->faker->name(),
            'alergias' => $this->faker->sentence(),
            'medicamentos' => $this->faker->sentence(),
            'historial_medico' => $this->faker->sentence(),
            'notas' => $this->faker->sentence(),
            'foto' => $this->faker->imageUrl(640, 480, 'people'),
            'estado_paciente' => $this->faker->randomElement(['activo', 'inactivo', 'suspendido']),
            'tipo_paciente' => $this->faker->randomElement(['regular', 'VIP', 'urgente']),
            'referido_por' => $this->faker->name(),
           
            // 'clinica_id' => Clinica::factory(), // Uncomment this line if you want to create a new clinica for each paciente
            // 'clinica_id' => Clinica::factory()->create()->id, // Uncomment this line if you want to create a new clinica for each paciente

        ];
    }
}
