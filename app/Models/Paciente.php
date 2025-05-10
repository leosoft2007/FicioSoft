<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Traits\HasRoles;

class Paciente extends Model
{
    use HasFactory;
    use HasAuditable;
    use HasRoles;

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
    /** @use HasFactory<\Database\Factories\PacienteFactory> */
    
    
    protected $perPage = 20;

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'telefono',
        'fecha_nacimiento',
        'direccion',
        'ciudad',
        'estado',
        'codigo_postal',
        'pais',
        'genero',
        'estado_civil',
        'ocupacion',
        'nacionalidad',
        'tipo_documento',
        'numero_documento',
        'telefono_emergencia',
        'nombre_contacto_emergencia',
        'alergias',
        'medicamentos',
        'historial_medico',
        'notas',
        'foto',
        'estado_paciente', // activo, inactivo, suspendido
        'tipo_paciente', // regular, VIP, urgente
        'clinica_id',
        'referido_por'
    ];
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $appends = [
        'full_name',
        'full_address',
    ];
    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
    public function getFullAddressAttribute()
    {
        return $this->direccion . ', ' . $this->ciudad . ', ' . $this->estado . ', ' . $this->codigo_postal . ', ' . $this->pais;
    }
    
    public function clinica(): BelongsTo
    {
        return $this->belongsTo(Clinica::class);
    }
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
    public function disponibles()
    {
        return $this->hasMany(Disponible::class);
    }
    public function consentimientos()
    {
        return $this->belongsToMany(Consentimiento::class, 'consentimiento_pacientes', 'paciente_id', 'consentimiento_id')
            ->withPivot('firma', 'firmado_en')
            ->withTimestamps();

            
    }
   

    
    
    // Relación M:M con citas a través de la tabla clases (citas grupales)
    public function clases()
    {
        return $this->belongsToMany(Cita::class, 'clases', 'paciente_id', 'cita_id');
    }

    public function scopeActivos($query)
    {
        return $query->where('estado_paciente', 'activo');
    }
    public function scopeInactivos($query)
    {
        return $query->where('estado_paciente', 'inactivo');
    }
    public function scopeSuspendidos($query)
    {
        return $query->where('estado_paciente', 'suspendido');
    }
    public function scopeVIP($query)
    {
        return $query->where('tipo_paciente', 'VIP');
    }

    //nombre completo
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}
