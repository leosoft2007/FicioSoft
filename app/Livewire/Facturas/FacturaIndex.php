<?php

namespace App\Livewire\Facturas;

use Livewire\Component;
use App\Models\Factura;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class FacturaIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $fechaInicio;
    public $fechaFin;
    public $clinica;

    protected $paginationTheme = 'tailwind'; // Usa TailwindCSS para estilos

    // Resetear la página cuando cambian los filtros


    public function render()
    {
        $this->authorize('view facturas');

        $this->clinica = Auth::user()->clinica;

        $query = Factura::with('paciente')
            ->where('clinica_id', $this->clinica->id);

        if ($this->fechaInicio) {

            $query->whereDate('fecha', '>=', $this->fechaInicio);
        }

        if ($this->fechaFin) {
            $query->whereDate('fecha', '<=', $this->fechaFin);
        }

        if ($this->search) {

            $query->whereHas('paciente', function ($q) {
                $q->where('apellido', 'like', '%' . $this->search . '%');
            });

        }


        $facturas = $query->orderByDesc('fecha')->paginate(10); // 10 por página

    return view('livewire.facturas.factura-index', compact('facturas'));

}
public function limpiar(){
    $this->reset(['search', 'fechaInicio', 'fechaFin']);
    $this->resetPage();
}



    public function editar($id)
    {
        $this->authorize('edit facturas');
        return redirect()->route('facturas.edit', $id);
    }

    public function descargarPdf($id)
    {
        return redirect()->route('facturas.pdf', $id); // Asegúrate de tener esta ruta
    }
}
