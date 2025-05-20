<?php

namespace App\Livewire\Forms;

use App\Models\Especialidad;
use Livewire\Form;

class EspecialidadForm extends Form
{
    public ?Especialidad $especialidadModel;

    public $nombre = '';
    public $descripcion = '';
    public $clinica_id;

    public function rules(): array
    {
        return [
			'nombre' => 'required|string',
			'descripcion' => 'string',
            
        ];
    }

    public function setEspecialidadModel(Especialidad $especialidadModel): void
    {
        $this->especialidadModel = $especialidadModel;

        $this->nombre = $this->especialidadModel->nombre;
        $this->descripcion = $this->especialidadModel->descripcion;
    }

    public function store(): void
    {
        $this->especialidadModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->especialidadModel->update($this->validate());

        $this->reset();
    }
}
