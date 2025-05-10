<?php

namespace Database\Factories;

use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        protected static $numero = 1000;
        public function definition(): array
    {
        $estado = $this->faker->randomElement(['pendiente', 'pagada', 'cancelada']);
        $metodoPago = $estado === 'pagada'
            ? $this->faker->randomElement(['efectivo', 'tarjeta'])
            : null;
        $paciente =  Paciente::withoutGlobalScopes()->inRandomOrder()->first();

        return [
            'paciente_id' => $paciente->id,
            'clinica_id' => 1,
            'fecha' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'total' => 0,
            'estado' => $estado,
            'metodo_pago' => $metodoPago,
            
            'descripcion' => $this->faker->optional()->sentence(),
            'enviado' => $this->faker->boolean(70), // 70% probabilidad de true
            'rectificada' => $this->faker->boolean(10), // 10% probabilidad de true
            'fecha_pago' => $estado === 'pagada' ? $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d') : null,
            'fecha_rectificacion' => $this->faker->boolean(10) ? $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d') : null,
        ];
    }
     public function configure()
    {
        return $this->afterCreating(function (Factura $factura) {
            $items = FacturaDetalle::factory()->count(3)->create([
                'factura_id' => $factura->id,
            ]);

            $total = $items->sum(fn ($item) => $item->subtotal);

            $factura->update(['total' => $total]);
        });
    }
}

