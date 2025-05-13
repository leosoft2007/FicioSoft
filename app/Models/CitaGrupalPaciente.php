<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use App\Traits\HasAuditable;
use App\Models\Scopes\ClinicaScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaGrupalPaciente extends Model
{
    /** @use HasFactory<\Database\Factories\CitaGrupalPacienteFactory> */

    use HasFactory;
    use HasAuditable;
    use HasRoles;
    protected $fillable = ['cita_grupal_ocurrencia_id', 'paciente_id','clinica_id'];

    protected static function booted()
    {
        static::addGlobalScope(new ClinicaScope);

        // Al crear una cita, asignamos automáticamente la clínica del usuario
        static::creating(function ($cita) {
            if (auth()->check()) {
                $cita->clinica_id = auth()->user()->clinica_id;
            }
        });
    }
    public function citaGrupalOcurrencia()
    {
        return $this->belongsTo(CitaGrupalOcurrencia::class);
    }
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }
}
