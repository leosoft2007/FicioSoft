<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Factura extends Model
{
    /** @use HasFactory<\Database\Factories\FacturaFactory> */
    use HasFactory;
    use Auditable;
    use HasRoles;  
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'paciente_id',
        'fecha',
        'total',
        'estado',
        'metodo_pago',
        'numero_factura',
        'descripcion',
        'clinica_id',
    ];
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }
    public function detalles()
    {
        return $this->hasMany(FacturaDetalle::class);
    }
    


}
