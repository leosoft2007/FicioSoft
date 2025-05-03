<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class Clinica extends Model
{
    /** @use HasFactory<\Database\Factories\ClinicaFactory> */
    use HasFactory;
    use Auditable;
    use HasRoles;  
    protected $perPage = 20;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'color',
        'nif',
        'direccion',
        'telefono',
        'email',
        'imagen',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
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
    public function especialidads()
    {
        return $this->belongsToMany(Especialidad::class, 'profesionals', 'clinica_id', 'especialidad_id')
                    ->withTimestamps();
    }
    
}
