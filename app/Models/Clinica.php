<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class Clinica extends Model
{
    use HasFactory;
    use HasAuditable;
    use HasRoles;

    protected $perPage = 20;

    protected $fillable = [
        'nombre', 'color', 'nif', 'direccion', 'telefono', 'email', 'imagen',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function pacientes(): HasMany
    {
        return $this->hasMany(Paciente::class);
    }

    public function profesionales(): HasMany
    {
        return $this->hasMany(Profesional::class);
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class);
    }

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class);
    }

    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'profesionals', 'clinica_id', 'especialidad_id')->withTimestamps();
    }

    public function consentimientos(): HasMany
    {
        return $this->hasMany(Consentimiento::class);
    }

    public function facturasDetalles(): HasMany
    {
        return $this->hasMany(FacturaDetalle::class);
    }

    public function disponibles(): HasMany
    {
        return $this->hasMany(Disponible::class);
    }

    
}
