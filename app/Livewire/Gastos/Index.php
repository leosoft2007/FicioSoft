<?php

namespace App\Livewire\Gastos;

use App\Models\Gasto;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $buscar = '';
    public $showFiltro = false;
    public $filtroMetodoPago = '';
    public $filtroFecha = '';
    public $filtroFechaInicio = '';
    public $filtroFechaFin = '';
    public function render(): View
    {
        $gastos = Gasto::with('tipoGasto')
            ->where(function ($query) {
                if ($this->buscar) {
                    $query->whereHas('tipoGasto', function ($q) {
                        $q->where('nombre', 'ilike', '%' . $this->buscar . '%');
                    })
                        ->orWhere('descripcion', 'ilike', '%' . $this->buscar . '%');
                }
            })
            ->when($this->filtroMetodoPago, function ($query) {
                $query->where('metodo_pago', $this->filtroMetodoPago);
            })
            ->when($this->filtroFechaInicio && $this->filtroFechaFin, function ($query) {
                $query->whereBetween('fecha', [$this->filtroFechaInicio, $this->filtroFechaFin]);
            })
            ->when($this->filtroFechaInicio && !$this->filtroFechaFin, function ($query) {
                $query->whereDate('fecha', '>=', $this->filtroFechaInicio);
            })
            ->when(!$this->filtroFechaInicio && $this->filtroFechaFin, function ($query) {
                $query->whereDate('fecha', '<=', $this->filtroFechaFin);
            })
            ->orderByDesc('fecha')
            ->paginate(10);

        return view('livewire.gasto.index', compact('gastos'))->with('i', $this->getPage() * $gastos->perPage());


    }

    public function delete(Gasto $gasto)
    {
        $gasto->delete();

        return $this->redirectRoute('gastos.index', navigate: true);
    }
}
