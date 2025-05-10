<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Traits\HasRoles;

class Profesional extends Model
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
    /** @use HasFactory<\Database\Factories\ProfesionalFactory> */
   
    protected $perPage = 20;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'clinica_id',
        'especialidad_id',
        'telefono',
        'email',
        'cif',
        'imagen',
        'direccion',
        'ciudad',
        'estado',
        'codigo_postal',
        'usuario_id',
        'estado_profesional', // activo, inactivo
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function clinica(): BelongsTo
    {
        return $this->belongsTo(Clinica::class);
    }
    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(Especialidad::class);
    }
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
    
}
