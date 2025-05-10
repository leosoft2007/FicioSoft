<?php

namespace App\Livewire\Forms;

use App\Models\Consentimiento;
use Livewire\Form;

class ConsentimientoForm extends Form
{
    public ?Consentimiento $consentimientoModel;
    
    public $titulo = '';
    public $contenido = '';
    public $tipo = '';
    public $clinica_id = 0;

    public function rules(): array
    {
        return [
			'titulo' => 'required|string',
			'contenido' => 'required|string',
			'tipo' => 'required|string',
            'clinica_id' => 'required|integer',
        ];
    }

    public function setConsentimientoModel(Consentimiento $consentimientoModel): void
    {
        $this->consentimientoModel = $consentimientoModel;
        
        $this->titulo = $this->consentimientoModel->titulo;
        $this->contenido = $this->consentimientoModel->contenido;
        $this->tipo = $this->consentimientoModel->tipo;
        $this->clinica_id = $this->consentimientoModel->clinica_id;
    }

    public function store(): void
    {
        $this->consentimientoModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->consentimientoModel->update($this->validate());

        $this->reset();
    }
}
