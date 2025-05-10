<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Clase extends Model
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
    
    /** @use HasFactory<\Database\Factories\ClaseFactory> */
    
    protected $perPage = 20;
    protected $fillable = [
        'paciente_id',
        'cita_id',
    ];
    public function clinica()
        {
            return $this->belongsTo(Clinica::class);
        }
    
}
