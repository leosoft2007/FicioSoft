<?php

namespace App\Livewire\Consentimientos;

use App\Livewire\Forms\ConsentimientoForm;
use App\Models\Consentimiento;
use Livewire\Component;

class Create extends Component
{
    public $fields = [
        [
            'name' => 'titulo',
            'label' => 'Título',
            'type' => 'text',
            'rules' => 'required|string|max:80',
        ],
        [
            'name' => 'contenido',
            'label' => 'Contenido',
            'type' => 'html',
            'rules' => 'required|string|max:5000',
        ],
        [
            'name' => 'tipo',
            'label' => 'Tipo de consentimiento',
            'type' => 'select',
            'options' => [
                'general' => 'General',
                'clinica' => 'Clínica',
                'profesional' => 'Profesional',
            ],
            'rules' => 'required|in:general,clinica,profesional',
        ],
    ];
    public $consentimiento;
    public $validationMessages = [
        'titulo.required' => 'El título es obligatorio.',
        'contenido.required' => 'El contenido es obligatorio.',
        'tipo.required' => 'El tipo de consentimiento es obligatorio.',
    ];
    public function mount()
    {
        $this->authorize('edit consentimientos');
    }

    public function render()
    {
        $this->authorize('create consentimientos');
        return view('livewire.consentimiento.create');
    }
}
