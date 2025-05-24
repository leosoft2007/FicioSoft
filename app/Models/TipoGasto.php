<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Scopes\ClinicaScope;

class TipoGasto extends Model
{
    /** @use HasFactory<\Database\Factories\TipoGastoFactory> */
    use HasFactory;
    use HasAuditable;
    use HasRoles;

    protected $fillable = [
        'nombre',
        'descripcion',
        'clinica_id',
    ];
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
    /**
     * Get the gastos associated with the tipo gasto.
     */
    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }
    /**
     * Get the clinica that owns the tipo gasto.
     */
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }

}
