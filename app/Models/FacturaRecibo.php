<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaRecibo extends Model
{
    protected $fillable = ['factura_id', 'recibo_id', 'valor'];
    protected $casts = [
        'valor' => 'decimal:2',
    ];
    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }
    public function recibo()
    {
        return $this->belongsTo(Recibo::class);
    }
}
