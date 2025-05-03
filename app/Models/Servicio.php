<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Servicio extends Model
{
    /** @use HasFactory<\Database\Factories\ServicioFactory> */
    use HasFactory;
    use Auditable;
    use HasRoles;
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
        'estado',
        'color',
        'icono',
    ];
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }
    public function detalles()
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
