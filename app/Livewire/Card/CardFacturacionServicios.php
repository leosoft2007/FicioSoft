<?php

namespace App\Livewire\Card;

use Livewire\Component;
use App\Models\Servicio;
use Carbon\Carbon;

class CardFacturacionServicios extends Component
{
    public $facturacionServicios = [];
    public $totalProximasCitas = 0;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $hace30Dias = now()->subDays(30)->toDateString();

        $this->facturacionServicios = Servicio::with(['facturaDetalles' => function ($query) use ($hace30Dias) {
                $query->whereHas('factura', function ($q) use ($hace30Dias) {
                    $q->where('estado', 'pagada')->where('fecha', '>=', $hace30Dias);
                });
            }])
            ->get()
            ->map(function ($servicio) {
                return [
                    'nombre' => $servicio->nombre,
                    'total' => optional($servicio->facturaDetalles)->sum('total') ?? 0
                ];
            })
            ->filter(fn($item) => $item['total'] > 0);
    }

    public function render()
    {
        return view('livewire.card.card-facturacion-servicios');
    }
}
