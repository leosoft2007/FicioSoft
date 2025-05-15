<?php

namespace App\Livewire\Forms;

use App\Models\Especialidad;
use App\Models\Profesional;
use Livewire\Form;

class ProfesionalForm extends Form
{

    public ?Profesional $profesionalModel;

    public $nombre = '';
    public $apellido = '';
    public $email = '';
    public $telefono = '';
    public $cif = '';
    public $direccion = '';
    public $ciudad = '';
    public $estado = '';
    public $codigo_postal = '';
    public $clinica_id = '';
    public $especialidad_id = '';
    public $usuario_id = '';
    public $color = '';


    public function rules(): array
    {
        return [
			'nombre' => 'required|string',
			'apellido' => 'required|string',
			'email' => 'required|string',
			'telefono' => 'string',
			'cif' => 'string',
			'direccion' => 'string',
			'ciudad' => 'string',
			'estado' => 'string',
			'codigo_postal' => 'string',
            'especialidad_id' => 'numeric',
            'usuario_id' => 'numeric',
            'color' => 'string',
        ];
    }

    public function setProfesionalModel(Profesional $profesionalModel): void
    {
        $clinicaId =auth()->user();

        $this->profesionalModel = $profesionalModel;

        $this->nombre = $this->profesionalModel->nombre;
        $this->apellido = $this->profesionalModel->apellido;
        $this->email = $this->profesionalModel->email;
        $this->telefono = $this->profesionalModel->telefono;
        $this->cif = $this->profesionalModel->cif;
        $this->direccion = $this->profesionalModel->direccion;
        $this->ciudad = $this->profesionalModel->ciudad;
        $this->estado = $this->profesionalModel->estado;
        $this->codigo_postal = $this->profesionalModel->codigo_postal;
        $this->clinica_id = $clinicaId->clinica_id;
        $this->especialidad_id = $this->profesionalModel->especialidad_id;
        $this->usuario_id = $clinicaId->id;
        $this->color = $this->profesionalModel->color;
    }

    public function store(): Profesional
    {

        $this->usuario_id = auth()->user()->id;
        $this->clinica_id = auth()->user()->clinica_id;


        $profesional = Profesional::create($this->validate());

        $this->reset();

        return $profesional;
    }

    public function update(): void
    {
        $this->profesionalModel->update($this->validate());

        $this->reset();
    }
}
