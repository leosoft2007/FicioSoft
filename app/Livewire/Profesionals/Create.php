<?php

namespace App\Livewire\Profesionals;


use App\Models\Especialidad;
use App\Models\Profesional;
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
            'name' => 'apellido',
            'label' => 'Apellido',
            'type' => 'text',
            'rules' => 'required|string|max:80',
        ],
        [
            'name' => 'email',
            'label' => 'Correo electrónico',
            'type' => 'email',
            'rules' => 'required|email',
        ],
        [
            'name' => 'telefono',
            'label' => 'Teléfono',
            'type' => 'text',
            'rules' => 'nullable',
        ],
        [
            'name' => 'especialidad_id',
            'label' => 'Especialidad',
            'type' => 'select-busqueda',
            'options_source' => [
                'model' => \App\Models\Especialidad::class,
                'label' => 'nombre',
                'key' => 'id',
            ],
            'valueField' => 'id',
            'labelField' => 'nombre',
            'rules' => 'required|exists:especialidads,id',
            'placeholder' => 'Seleccione una especialidad',
            'primaryColor' => 'indigo-600',
            'hoverColor' => 'indigo-50',
        ],
        [
            'name' => 'cif',
            'label' => 'CIF',
            'type' => 'text',
            'rules' => 'nullable|string|max:20',
        ],
        [
            'name' => 'direccion',
            'label' => 'Dirección',
            'type' => 'text',
            'rules' => 'nullable|string|max:255',
        ],
        [
            'name' => 'ciudad',
            'label' => 'Ciudad',
            'type' => 'text',
            'rules' => 'nullable|string|max:100',
        ],
        [
            'name' => 'estado',
            'label' => 'Activo-Inactivo',
            // Este campo puede ser un checkbox o un select
            'type' => 'select',
            'options' => [
                '1' => 'Activo',
                '0' => 'Inactivo',
            ],
            'rules' => 'required|boolean',
        ],
        [
            'name' => 'codigo_postal',
            'label' => 'Código Postal',
            'type' => 'text',
            'rules' => 'nullable|string|max:20',
        ],
        [
            'name' => 'color',
            'label' => 'Color (opcional)',
            // Este campo es opcional y puede ser un color hexadecimal
            // o cualquier otro formato que desees usar
            'type' => 'color', // Asumiendo que tienes un tipo de campo color
        ],
    ];
    public $validationMessages = [
        'formData.nombre.required' => 'El nombre es obligatorio.',
        'formData.apellido.required' => 'El apellido es obligatorio.',
        'formData.email.required' => 'El correo electrónico es obligatorio.',
        'formData.email.email' => 'El correo electrónico debe ser válido.',
        'formData.especialidad_id.required' => 'Debe seleccionar una especialidad.',
        // ...otros mensajes...
    ];
    public $profesional;
    public $formData = [];

    public function mount()
    {

        $this->authorize('create profesionals');


    }

    public function render()
    {
        $this->authorize('create profesionals');
        return view('livewire.profesional.create');
    }
}
