<?php

namespace App\Livewire\Especialidads;


use App\Models\Especialidad;
use Livewire\Component;

class Create extends Component
{
    public $fields = [
        [
            'name' => 'nombre',
            'label' => 'Nombre',
            'type' => 'text',
            'rules' => 'required|string|max:80',
        ],
        [
            'name' => 'descripcion',
            'label' => 'Descripción',
            'type' => 'textarea',
            'rules' => 'nullable|string|max:255',
        ],
    ];
    public $validationMessages = [
        'formData.nombre.required' => 'El nombre es obligatorio.',
        'formData.descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
    ];

    public function render()
    {
        $this->authorize('create especialidads');
        return view('livewire.especialidad.create');
    }
}
