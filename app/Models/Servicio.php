<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\BelongsToClinica;
use App\Traits\HasAuditable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Servicio extends Model
{
    use HasFactory;
    use HasAuditable;
    use HasRoles;
    use BelongsToClinica;

    public static $hasClinica = true;
    /** @use HasFactory<\Database\Factories\ServicioFactory> */

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'clinica_id',
        'nombre',
        'descripcion',
        'precio',
        'iva',
        'estado',
    ];
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }
    public function facturaDetalles()
    {
        return $this->hasMany(FacturaDetalle::class);
    }
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }
    public function scopeInactivos($query)
    {
        return $query->where('estado', 'inactivo');
    }

}
