<?php

namespace App\Livewire\Forms;

use App\Models\Gasto;
use Livewire\Form;

class GastoForm extends Form
{
    public ?Gasto $gastoModel;

    public $descripcion = '';
    public $monto = '';
    public $fecha = '';
    public $metodo_pago = '';
    public $tipo_gasto_id = '';

    public function rules(): array
    {
        return [
			'descripcion' => 'required|string',
			'monto' => 'required',
			'fecha' => 'required',
			'metodo_pago' => 'string',
			'tipo_gasto_id' => 'required',
        ];
    }

    public function setGastoModel(Gasto $gastoModel): void
    {
        $this->gastoModel = $gastoModel;

        $this->descripcion = $this->gastoModel->descripcion;
        $this->monto = $this->gastoModel->monto;
        $this->fecha = $this->gastoModel->fecha;
        $this->metodo_pago = $this->gastoModel->metodo_pago;
        $this->tipo_gasto_id = $this->gastoModel->tipo_gasto_id;
    }

    public function store(): void
    {
        $this->gastoModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->gastoModel->update($this->validate());

        $this->reset();
    }
}
