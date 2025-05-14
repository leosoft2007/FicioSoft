<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Consentimiento extends Model
{
     use HasFactory;
    use HasRoles;
    use HasAuditable;

    protected static function booted()
    {
        static::addGlobalScope(new ClinicaScope);

        // Al crear una cita, asignamos automáticamente la clínica del usuario
        static::creating(function ($registro) {
            if (auth()->check()) {
                $registro->clinica_id = auth()->user()->clinica_id;
            }
        });
    }


    protected $fillable = [
        'titulo',
        'contenido',
        'tipo', // general, clinica, profesional
        'clinica_id',
    ];

    public function pacientes()
            {
                return $this->belongsToMany(Paciente::class, 'consentimiento_pacientes', 'consentimiento_id', 'paciente_id')
                    ->withPivot('firma', 'firmado_en')
                    ->withTimestamps();
                    
            }
    public function consentimientoPacientes()
    {
        return $this->hasMany(ConsentimientoPaciente::class);
    }
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }


}
