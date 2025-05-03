<?php

namespace Database\Factories;

use App\Models\Clinica;
use App\Models\Especialidad;
use App\Models\Paciente;
use App\Models\Profesional;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Obtiene asociaciones aleatorias o crea nuevas si no existen
        $paciente = Paciente::inRandomOrder()->first() ?: Paciente::factory()->create();
        $clinica = Clinica::inRandomOrder()->first() ?: Clinica::factory()->create();
        $profesional = Profesional::inRandomOrder()->first() ?: Profesional::factory()->create();
        $especialidad = Especialidad::inRandomOrder()->first() ?: Especialidad::factory()->create();
        $servicio = $clinica->servicios()->inRandomOrder()->first() ?: $clinica->servicios()->create();

        // Fecha y hora dentro del próximo mes
        $date = $this->faker->dateTimeBetween('now', '+1 month');
        $start = (clone $date)->setTime(
            $this->faker->numberBetween(8, 17),
            $this->faker->randomElement([0, 15, 30, 45])
        );
        $duraciones = [30, 45, 60, 90];
        $duracion = Arr::random($duraciones);

        $end = (clone $start)->modify("+{$duracion} minutes");

        return [
            'paciente_id'    => $paciente->id,
            'clinica_id'     => $clinica->id,
            'profesional_id' => $profesional->id,
            'especialidad_id'=> $especialidad->id,
            'servicio_id'    => $servicio->id,
            'fecha'          => $start->format('Y-m-d'),
            'hora_inicio'    => $start->format('H:i:s'),
            'hora_fin'       => $end->format('H:i:s'),
            'tipo'           => $this->faker->randomElement(['individual', 'grupal']),
            'estado'         => $this->faker->randomElement(['pendiente', 'confirmado', 'cancelado']),
            'observaciones'  => $this->faker->optional()->sentence(),
        ];
    }
}
