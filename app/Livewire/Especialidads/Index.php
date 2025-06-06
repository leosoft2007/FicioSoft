<?php

namespace App\Livewire\Especialidads;

use App\Models\Especialidad;
use Illuminate\View\View;
use Livewire\Component;


class Index extends Component
{
    public $columnsEspecialidad = [
        ['field' => 'nombre', 'label' => 'Título', 'searchable' => true, 'show_in_mobile' => true],
        ['field' => 'descripcion', 'label' => 'Contenido', 'searchable' => true, 'format' => 'fondo', 'fondo_palette' => 'indigo', 'show_in_mobile' => true],
    ];

    public $especialidads;


    public function render(): View
    {
        // contar las especialidades
        $this->especialidads = Especialidad::all()->count();

        return view('livewire.especialidad.index', [
            'especialidads' => $this->especialidads
        ]);

    }


}
