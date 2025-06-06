<?php

namespace App\Livewire\Consentimientos;

use App\Models\Consentimiento;
use Illuminate\View\View;
use Livewire\Component;


class Index extends Component
{
    public $columnsConsentimiento = [
        ['field' => 'titulo', 'label' => 'Título', 'searchable' => true, 'format' => 'fondo', 'fondo_palette' => 'indigo', 'show_in_mobile' => true],
        ['field' => 'contenido', 'label' => 'Contenido', 'searchable' => true, 'format' => 'limit_html', 'fondo_palette' => 'indigo', 'show_in_mobile' => true],
        [
            'field' => 'tipo',
            'label' => 'Tipo',
            'searchable' => true,
            'format' => 'badge',
            'badge_map' => [
                'clinica' => 'verde',
                'profesional' => 'indigo',
                'general' => 'amarillo',
            ],
            'show_in_mobile' => true,
            'sortable' => false,
            'filter' => 'select',
            'options' => ['clinica', 'profesional', 'general'],
            
        ],
    ];


    public function render(): View
    {
        // identificamos el usuario autenticado
        $clinica = auth()->user()->clinica;

        // listamos los concentimientos de la clinica
        $consentimientos = Consentimiento::where('clinica_id', $clinica->id)->get()->count();


        return view('livewire.consentimiento.index', [
            'consentimientos' => $consentimientos
        ]);
    }


}
