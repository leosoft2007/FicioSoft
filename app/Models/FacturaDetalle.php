<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class FacturaDetalle extends Model
{
    /** @use HasFactory<\Database\Factories\FacturaDetalleFactory> */
    use HasFactory;
    use Auditable;
    use HasRoles;
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
    ];
    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
    
}
