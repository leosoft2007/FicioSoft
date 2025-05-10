<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Disponible extends Model
{
    use HasFactory;
    use HasRoles;
    use HasAuditable;
  
    /** @use HasFactory<\Database\Factories\DisponibleFactory> */
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
        'paciente_id',
        'dia',
        'hora_inicio',
        'hora_fin',
    ];
    protected $casts = [
        'hora_inicio' => 'datetime:H:i',
        'hora_fin' => 'datetime:H:i',
    ];
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }
    
}
