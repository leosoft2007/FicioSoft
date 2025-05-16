<?php

namespace App\Livewire\Forms;

use App\Models\Servicio;
use Livewire\Form;

class ServicioForm extends Form
{
    public ?Servicio $servicioModel;

    public $nombre = '';
    public $descripcion = '';
    public $precio = '';
    public $iva = '';
    public $estado = '';

    public function rules(): array
    {
        return [
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'iva' => ['required', 'numeric', 'between:0,0.99', 'regex:/^0(\.\d{1,2})?$/'],
            'estado' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'precio.between' => 'El precio debe estar entre 0 y 99999999.99.',
            'iva.required' => 'El IVA es obligatorio.',
            'iva.numeric' => 'El IVA debe ser un número válido entre 0 y 0.99.',
            'iva.between' => 'El IVA debe estar entre 0 y 0.99.',
        ];
    }

    public function setServicioModel(Servicio $servicioModel): void
    {
        $this->servicioModel = $servicioModel;

        $this->nombre = $this->servicioModel->nombre;
        $this->descripcion = $this->servicioModel->descripcion;
        $this->precio = $this->servicioModel->precio;
        $this->iva = $this->servicioModel->iva;
        $this->estado = $this->servicioModel->estado;
    }

    public function store(): void
    {
        $this->servicioModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->servicioModel->update($this->validate());

        $this->reset();
    }
}
