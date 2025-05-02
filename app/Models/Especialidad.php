<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class Especialidad extends Model
{
    /** @use HasFactory<\Database\Factories\EspecialidadFactory> */
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
        'descripcion',
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
    
    public function profesionals()
    {
        return $this->hasMany(Profesional::class, 'id', 'especialidad_id');
    }
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'especialidad_id');
    }
    public function clinicas()
    {
        return $this->belongsToMany(Clinica::class, 'profesionals', 'especialidad_id', 'clinica_id')
                    ->withTimestamps();
    }
    
   
}