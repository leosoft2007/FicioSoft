<?php

namespace App\Livewire\Recibos;

use App\Models\Recibo;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $buscar = '';
    public $showFiltro = false;
    public $filtroFormaPago = '';
    public $filtroFecha = '';
    public $filtroFechaInicio = '';
    public $filtroFechaFin = '';

    public function render(): View
    {
        $recibos = Recibo::query()
            ->when($this->buscar, function ($query) {
                $query->where('id', 'ilike', "%{$this->buscar}%")
                    ->orWhereRaw('CAST(valor AS TEXT) ILIKE ?', ["%{$this->buscar}%"])
                    ->orWhereHas('paciente', function ($q) {
                        $q->whereRaw("CONCAT(nombre, ' ', apellido) ILIKE ?", ["%{$this->buscar}%"]);
                    });
            })
            ->when($this->filtroFormaPago, fn($query) =>
                $query->where('formadepago', $this->filtroFormaPago)
            )
            ->when($this->filtroFechaInicio && $this->filtroFechaFin, fn($query) =>
                $query->whereBetween('fecha', [$this->filtroFechaInicio, $this->filtroFechaFin])
            )
            ->when($this->filtroFechaInicio && !$this->filtroFechaFin, fn($query) =>
                $query->whereDate('fecha', '>=', $this->filtroFechaInicio)
            )
            ->when(!$this->filtroFechaInicio && $this->filtroFechaFin, fn($query) =>
                $query->whereDate('fecha', '<=', $this->filtroFechaFin)
            )
            ->paginate();

        return view('livewire.recibo.index', compact('recibos'))
            ->with('i', $this->getPage() * $recibos->perPage());
    }

    public function delete(Recibo $recibo)
    {
        $recibo->delete();

        return $this->redirectRoute('recibos.index', navigate: true);
    }
}
