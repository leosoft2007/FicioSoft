<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\BelongsToClinica;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class FacturaDetalle extends Model
{
    use HasFactory;
    use HasAuditable;
    use HasRoles;
    use BelongsToClinica;

    public static $hasClinica = true;

    /** @use HasFactory<\Database\Factories\FacturaDetalleFactory> */

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'factura_id',
        'servicio_id',
        'descripcion',
        'precio_unitario',
        'cantidad',
        'subtotal',
        'iva',
        'total',
        'iva_porcentaje',
    ];
    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }
}
