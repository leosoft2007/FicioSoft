<?php

namespace App\Livewire\Forms;

use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class PacienteForm extends Form
{
    public ?Paciente $pacienteModel;

    public $nombre = '';
    public $apellido = '';
    public $email = '';
    public $telefono = '';
    public $fecha_nacimiento = '';
    public $direccion = '';
    public $ciudad = '';
    public $estado = '';
    public $codigo_postal = '';
    public $pais = '';
    public $genero = '';
    public $estado_civil = '';
    public $ocupacion = '';
    public $nacionalidad = '';
    public $tipo_documento = '';
    public $numero_documento = '';
    public $telefono_emergencia = '';
    public $nombre_contacto_emergencia = '';
    public $alergias = '';
    public $medicamentos = '';
    public $historial_medico = '';
    public $notas = '';
    public $foto = '';
    public $estado_paciente = '';
    public $tipo_paciente = '';
    public $referido_por = '';
    public $clinica_id = '';


    public function rules(): array
    {
        return [
			'nombre' => 'required|string',
			'apellido' => 'required|string',
			'email' => 'required|string',
			'telefono' => 'string',
			'direccion' => 'string',
			'ciudad' => 'string',
			'estado' => 'string',
			'codigo_postal' => 'string',
			'pais' => 'string',
			'genero' => 'string',
			'estado_civil' => 'string',
			'ocupacion' => 'string',
			'nacionalidad' => 'string',
			'tipo_documento' => 'string',
			'numero_documento' => 'string',
			'telefono_emergencia' => 'string',
			'nombre_contacto_emergencia' => 'string',
			'alergias' => 'string',
			'medicamentos' => 'string',
			'historial_medico' => 'string',
			'notas' => 'string',
			'foto' => 'string',
			'estado_paciente' => 'string',
			'tipo_paciente' => 'string',
  			'referido_por' => 'string',
        ];
    }


    public function setPacienteModel(Paciente $pacienteModel): void
    {
       // Obtener el ID de la clínica del usuario autenticado
       $clinicaId = auth()->user()->clinica_id;


        $this->pacienteModel = $pacienteModel;

        $this->nombre = $this->pacienteModel->nombre;
        $this->apellido = $this->pacienteModel->apellido;
        $this->email = $this->pacienteModel->email;
        $this->telefono = $this->pacienteModel->telefono;
        $this->fecha_nacimiento = $this->pacienteModel->fecha_nacimiento;
        $this->direccion = $this->pacienteModel->direccion;
        $this->ciudad = $this->pacienteModel->ciudad;
        $this->estado = $this->pacienteModel->estado;
        $this->codigo_postal = $this->pacienteModel->codigo_postal;
        $this->pais = $this->pacienteModel->pais;
        $this->genero = $this->pacienteModel->genero;
        $this->estado_civil = $this->pacienteModel->estado_civil;
        $this->ocupacion = $this->pacienteModel->ocupacion;
        $this->nacionalidad = $this->pacienteModel->nacionalidad;
        $this->tipo_documento = $this->pacienteModel->tipo_documento;
        $this->numero_documento = $this->pacienteModel->numero_documento;
        $this->telefono_emergencia = $this->pacienteModel->telefono_emergencia;
        $this->nombre_contacto_emergencia = $this->pacienteModel->nombre_contacto_emergencia;
        $this->alergias = $this->pacienteModel->alergias;
        $this->medicamentos = $this->pacienteModel->medicamentos;
        $this->historial_medico = $this->pacienteModel->historial_medico;
        $this->notas = $this->pacienteModel->notas;
        $this->foto = $this->pacienteModel->foto;
        $this->estado_paciente = $this->pacienteModel->estado_paciente;
        $this->tipo_paciente = $this->pacienteModel->tipo_paciente;
        $this->referido_por = $this->pacienteModel->referido_por;
        $this->clinica_id = $clinicaId;

    }

    public function store(): void
    {
        if (!is_string($this->foto) || $this->foto === '' || $this->foto === null || is_array($this->foto) || is_integer($this->foto)) {
            $this->foto = 'sin foto';
        }
        try {
            $data = $this->validate();
           // dd($data);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->validator->errors()->toArray());
        }
       
        $this->pacienteModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->pacienteModel->update($this->validate());

        $this->reset();
    }
}
