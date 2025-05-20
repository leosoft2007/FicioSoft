<?php

namespace App\Livewire\Facturas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Factura;
use App\Models\Paciente;
use App\Models\Clinica;
use App\Exports\FacturasExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaListado extends Component
{
    use WithPagination;

    public $search = '';
    public $fechaInicio;
    public $fechaFin;
    public $estado = '';
    public $clinica_id = '';
    public $porPagina = 10;
    public $sortField = 'fecha';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'fechaInicio' => ['except' => ''],
        'fechaFin' => ['except' => ''],
        'estado' => ['except' => ''],
        'clinica_id' => ['except' => ''],
        'porPagina' => ['except' => 10],
        'sortField' => ['except' => 'fecha'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        // Opcional: establecer fechas por defecto (ej. mes actual)
        $this->fechaInicio = now()->startOfMonth()->format('Y-m-d');
        $this->fechaFin = now()->endOfMonth()->format('Y-m-d');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $this->authorize('view facturas');
        $this->clinica_id = auth()->user()->clinica_id;

        $query = Factura::with(['paciente', 'clinica'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('numero_factura', 'like', '%'.$this->search.'%')
                      ->orWhereHas('paciente', function ($q) {
                          $q->where('nombre', 'like', '%'.$this->search.'%')
                            ->orWhere('apellido', 'like', '%'.$this->search.'%');
                      });
                });
            })
            ->when($this->fechaInicio && $this->fechaFin, function ($query) {
                $query->whereBetween('fecha', [$this->fechaInicio, $this->fechaFin]);
            })
            ->when($this->estado, function ($query) {
                $query->where('estado', $this->estado);
            })
            ->when($this->clinica_id, function ($query) {
                $query->where('clinica_id', $this->clinica_id);
            })
            ->orderBy($this->sortField, $this->sortDirection);

        $facturas = $query->paginate($this->porPagina);
        //clinica del usuario autenticado



        return view('livewire.facturas.factura-listado', [
            'facturas' => $facturas,
            'estados' => ['pendiente', 'pagada', 'cancelada']
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function exportarPdf()
{
    $facturas = $this->getFacturasForExport();

    $pdf = Pdf::loadView('pdf.facturas-pdf-listado', [
        'facturas' => $facturas,
        'fechaInicio' => $this->fechaInicio,
        'fechaFin' => $this->fechaFin,
        'estado' => $this->estado,
        'clinica' => $this->clinica_id ? Clinica::find($this->clinica_id)->nombre : 'Todas'
    ]);

    return response()->streamDownload(
        fn () => print($pdf->output()),
        "facturas_{$this->fechaInicio}_a_{$this->fechaFin}.pdf"
    );
}

public function exportarExcel()
{
    return Excel::download(
        new FacturasExport($this->getFacturasForExport()),
        "facturas_{$this->fechaInicio}_a_{$this->fechaFin}.xlsx"
    );
}

protected function getFacturasForExport()
{
    return Factura::with(['paciente', 'clinica'])
        ->when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('numero_factura', 'like', '%'.$this->search.'%')
                  ->orWhereHas('paciente', function ($q) {
                      $q->where('nombre', 'like', '%'.$this->search.'%')
                        ->orWhere('apellidos', 'like', '%'.$this->search.'%');
                  });
            });
        })
        ->when($this->fechaInicio && $this->fechaFin, function ($query) {
            $query->whereBetween('fecha', [$this->fechaInicio, $this->fechaFin]);
        })
        ->when($this->estado, function ($query) {
            $query->where('estado', $this->estado);
        })
        ->when($this->clinica_id, function ($query) {
            $query->where('clinica_id', $this->clinica_id);
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->get();
}
}

