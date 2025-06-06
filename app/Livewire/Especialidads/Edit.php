<?php

namespace App\Livewire\Especialidads;

use App\Livewire\Forms\EspecialidadForm;
use App\Models\Especialidad;
use Livewire\Component;

class Edit extends Component
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
    public $especialidad;
    public $validationMessages = [
        'formData.nombre.required' => 'El nombre es obligatorio.',
        'formData.descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
    ];
    public function mount(Especialidad $especialidad)
    {
        $this->authorize('edit especialidads');
    }
    public function render()
    {
        $this->authorize('edit especialidads');
        return view('livewire.especialidad.edit');
    }
}
