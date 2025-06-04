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

    // En tu Controller o en el método render() de tu componente Livewire
    public $columnsRecibo = [
        ['field' => 'id_long', 'label' => 'Número', 'format' => null, 'sortable' => false, 'show_in_mobile' => true, 'searchable' => false],
        ['field' => 'paciente.nombre', 'label' => 'Nombre', 'searchable' => true, 'format' => 'nombre', 'show_in_mobile' => true],
        ['field' => 'paciente.apellido', 'label' => 'Apellido', 'searchable' => true, 'format' => null, 'show_in_mobile' => true],
        ['field' => 'fecha', 'label' => 'Fecha', 'searchable' => false, 'format' => 'date', 'show_in_mobile' => true, 'filter' => 'range_date',],
        ['field' => 'valor', 'label' => 'Valor', 'searchable' => true, 'format' => 'money', 'show_in_mobile' => true, 'filter' => 'range_number'],
        [
            'field' => 'formadepago',
            'label' => 'Forma de Pago',
            'format' => 'badge',
            'badge_map' => [
                'efectivo' => 1,
                'tarjeta' => 2,
                'transferencia' => 3,
                'bizum' => 4,
            ],
            'icon' => '<svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none"><path d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" /></svg>',
            'show_in_mobile' => true, 'filter' => 'select', 'options' => ['efectivo', 'tarjeta', 'cheque']],
    ];
    public $columnsFactura = [
        ['field' => 'numero_factura', 'label' => 'Número', 'format' => null, 'show_in_mobile' => true, 'searchable' => true],
        ['field' => 'paciente.nombre', 'label' => 'Nombre', 'searchable' => true, 'format' => 'nombre', 'show_in_mobile' => true],
        ['field' => 'paciente.apellido', 'label' => 'Apellido', 'searchable' => true, 'format' => null, 'show_in_mobile' => true],
        ['field' => 'fecha', 'label' => 'Fecha', 'searchable' => false, 'format' => 'date', 'show_in_mobile' => true, 'filter' => 'range_date'],
        ['field' => 'total', 'label' => 'Total', 'searchable' => true, 'format' => 'money', 'show_in_mobile' => true, 'filter' => 'range_number'],
        ['field' => 'metodo_pago',
            'label' => 'Forma de Pago',
            'format' => 'badge',
            'badge_map' => [
                'efectivo' => 1,
                'tarjeta' => 2,
                'transferencia' => 3,
                'bizum' => 4,
            ],
            'icon' => '<svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none"><path d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" /></svg>',
            'show_in_mobile' => true,
            'filter' => 'select',
            'options' => ['efectivo', 'tarjeta', 'transferencia', 'bizum'],
        ],
        ['field' => 'estado', 'label' => 'Estado', 'format' => 'badge', 'badge_map' => ['pendiente' => 4, 'pagada' => 2, 'cancelada' => 6], 'show_in_mobile' => true, 'filter' => 'select', 'options' => ['pendiente', 'pagada', 'cancelada']],
    ];



    public function render(): View
    {
        $recibos = Recibo::all();
        $cantidad = $recibos->count();


        return view('livewire.recibo.index', compact('recibos', 'cantidad'));
    }

    public function delete(Recibo $recibo)
    {
        $recibo->delete();

        return $this->redirectRoute('recibos.index', navigate: true);
    }
}
