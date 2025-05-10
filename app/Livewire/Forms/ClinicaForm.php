<?php

namespace App\Livewire\Forms;

use App\Models\Clinica;
use Livewire\Form;

class ClinicaForm extends Form
{
    public ?Clinica $clinicaModel;
    
    public $nombre = '';
    public $color = '';
    public $nif = '';
    public $direccion = '';
    public $telefono = '';
    public $email = '';
    public $imagen = '';

    public function rules(): array
    {
        return [
			'nombre' => 'required|string',
			'color' => 'string',
			'nif' => 'string',
			'direccion' => 'string',
			'telefono' => 'string',
			'email' => 'string',
			'imagen' => 'string',
        ];
    }

    public function setClinicaModel(Clinica $clinicaModel): void
    {
        $this->clinicaModel = $clinicaModel;
        
        $this->nombre = $this->clinicaModel->nombre;
        $this->color = $this->clinicaModel->color;
        $this->nif = $this->clinicaModel->nif;
        $this->direccion = $this->clinicaModel->direccion;
        $this->telefono = $this->clinicaModel->telefono;
        $this->email = $this->clinicaModel->email;
        $this->imagen = $this->clinicaModel->imagen;
    }

    public function store(): void
    {
        $this->clinicaModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->clinicaModel->update($this->validate());

        $this->reset();
    }
}
