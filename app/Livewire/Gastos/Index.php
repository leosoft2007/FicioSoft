<?php

namespace App\Livewire\Gastos;

use App\Models\Gasto;
use Illuminate\View\View;
use Livewire\Component;


class Index extends Component
{


    public $columnsGastos = [
        [
            'field' => 'tipoGasto.nombre',
            'label' => 'Tipo de Gasto',
            'format' => 'fondo',
            'fondo_palette' => 'blanco',
            'filter' => 'relation-select',
            'relation_field' => 'tipo_gasto_id',
            'relation_label' => 'nombre', // <-- campo a mostrar como label
            'relation_model' => \App\Models\TipoGasto::class, // <-- agrega esto para hacerlo genérico
            'options' => [], // se llena en mount()
        ],
        ['field' => 'descripcion', 'label' => 'Descripción', 'show_in_mobile' => true, 'searchable' => true, 'format' => 'fondo', 'fondo_palette' => 'gris'],
        ['field' => 'fecha', 'label' => 'Fecha', 'searchable' => false, 'format' => 'date', 'show_in_mobile' => true, 'filter' => 'range_date'],
        ['field' => 'monto', 'label' => 'Monto', 'searchable' => true, 'format' => 'money', 'show_in_mobile' => true, 'filter' => 'range_number'],
        [
            'field' => 'metodo_pago',
            'label' => 'Forma de Pago',
            'format' => 'badge',
            'badge_map' => [
                'Contado' => 'verde',
                'Tarjeta de Crédito' => 'azul',
                'Transferencia Bancaria' => 'indigo',
                'Bizum' => 'amarillo',
                'Cheque' => 'rojo',
                'Efectivo' => 'verde',
            ],
            'icon' => '<svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none"><path d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" /></svg>',
            'show_in_mobile' => true,
            'filter' => 'select',
            'options' => ['Contado', 'Tarjeta de Crédito', 'Transferencia Bancaria', 'Bizum', 'Cheque', 'Efectivo'],
        ],


    ];




    public function render(): View

    {


        return view('livewire.gasto.index');


    }


}
