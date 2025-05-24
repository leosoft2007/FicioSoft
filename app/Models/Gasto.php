<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Scopes\ClinicaScope;

class Gasto extends Model
{
    /** @use HasFactory<\Database\Factories\GastoFactory> */
    use HasFactory;
    use HasAuditable;
    use HasRoles;

    protected $fillable = [
        'descripcion',
        'monto',
        'fecha',
        'metodo_pago',
        'clinica_id',
        'user_id',
        'tipo_gasto_id',
    ];
    protected $casts = [
        'fecha' => 'datetime',
    ];
    protected static function booted()
    {
        static::addGlobalScope(new ClinicaScope);

        // Al crear una cita, asignamos automáticamente la clínica del usuario y el usuario
        // que está creando el gasto
        // Esto es útil para auditoría y control de acceso
        static::creating(function ($registro) {
            if (auth()->check()) {
                $registro->clinica_id = auth()->user()->clinica_id;
                $registro->user_id = auth()->user()->id;
            }
        });
    }
    /**
     * Get the tipo gasto associated with the gasto.
     */
    public function tipoGasto()
    {
        return $this->belongsTo(TipoGasto::class);
    }
    /**
     * Get the usuario associated with the gasto.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Get the clinica associated with the gasto.
     */
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }

}
