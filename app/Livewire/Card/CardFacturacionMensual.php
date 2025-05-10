<?php

namespace App\Livewire\Card;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Factura;

class CardFacturacionMensual extends Component
{
    public $facturacionMes = 0;
    public $comparacionFacturacion = 0;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->facturacionMes = Factura::whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year)
            ->where('estado', 'pagada')
            ->sum('total');

        $lastMonth = now()->subMonth()->month;
        $lastYear = now()->subMonth()->year;

        $facturacionLastMonth = Factura::whereMonth('fecha', $lastMonth)
            ->whereYear('fecha', $lastYear)
            ->where('estado', 'pagada')
            ->sum('total');

        if ($facturacionLastMonth > 0) {
            $this->comparacionFacturacion = round((($this->facturacionMes - $facturacionLastMonth) / $facturacionLastMonth) * 100, 1);
        } else {
            $this->comparacionFacturacion = $this->facturacionMes > 0 ? 100 : 0;
        }
    }

    public function render()
    {
        return view('livewire.card.card-facturacion-mensual');
    }
}
