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
        // seleccionar la clinica_id=1
       $clinica = Clinica::find(1);

        
        // Obtiene asociaciones aleatorias o crea nuevas si no existen
        $paciente = Paciente::withoutGlobalScopes()->inRandomOrder()->first() ?: Paciente::factory()->create();
        
        $profesional = Profesional::withoutGlobalScopes()->inRandomOrder()->first() ?: Profesional::factory()->create();
        
        $servicio = $clinica->servicios()->withoutGlobalScopes()->inRandomOrder()->first() ?: $clinica->servicios()->create();

        // Fecha y hora dentro del próximo mes
        $date = $this->faker->dateTimeBetween('now', '+4 month');
        $start = (clone $date)->setTime(
            $this->faker->numberBetween(8, 17),
            $this->faker->randomElement([0, 15, 30, 45])
        );
        $duraciones = [30, 45, 60, 90];
        $duracion = Arr::random($duraciones);

        $end = (clone $start)->modify("+{$duracion} minutes");

        return [
            'paciente_id'    => $paciente->id,
            'clinica_id'     => 1,
            'profesional_id' => $profesional->id,
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
