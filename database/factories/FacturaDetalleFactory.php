<?php

namespace Database\Factories;

use App\Models\Clinica;
use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FacturaDetalle>
 */
class FacturaDetalleFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $clinica = Clinica::find(1);
        $servicio = $clinica->servicios()->withoutGlobalScopes()->inRandomOrder()->first() ?: $clinica->servicios()->create();
        $precio =$this->faker->randomFloat(2, 1, 100);
        $cantidad = $this->faker->numberBetween(1, 10);
        $iva = $this->faker->randomFloat(2, 0, 21);
        
        return [
            'cantidad' => $cantidad,
            'precio_unitario' => $precio,
            // 'subtotal' = (cantidad * precio_unitario)
            'subtotal' => $cantidad * $precio,
            'iva' => $iva,
            //total = (cantidad * precio_unitario) * iva /100 + (cantidad * precio_unitario)
            'total' => ($cantidad * $precio) * ($iva / 100) + ($cantidad * $precio),
            'clinica_id' => 1,
            'servicio_id' =>  $servicio->id,
            'descripcion' => $this->faker->sentence(),
            
        ];
    }
}
