<?php

namespace App\Livewire\Forms;

use App\Models\Recibo;
use Livewire\Form;

class ReciboForm extends Form
{
    public ?Recibo $reciboModel;


    public $paciente_id = '';
    public $numero = '';
    public $fecha = '';
    public $valor = '';
    public $formadepago = '';
    public $observacion = '';

    public function rules(): array
    {
        return [

			'paciente_id' => 'required',

			'fecha' => 'required',
			'valor' => 'required',
			'formadepago' => 'required|string',
			'observacion' => 'string',
        ];
    }

    public function setReciboModel(Recibo $reciboModel): void
    {
        $this->reciboModel = $reciboModel;


        $this->paciente_id = $this->reciboModel->paciente_id;


        $this->fecha = $this->reciboModel->fecha;
        $this->valor = $this->reciboModel->valor;
        $this->formadepago = $this->reciboModel->formadepago;
        $this->observacion = $this->reciboModel->observacion;
    }

    public function store(): void
    {

        $this->reciboModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->reciboModel->update($this->validate());

        $this->reset();
    }
}
