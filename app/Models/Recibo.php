<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToClinica;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Recibo extends Model
{
    use HasFactory;
    use HasAuditable;
    use HasRoles;
    use BelongsToClinica;
    public static $hasClinica = true;

    protected $fillable = [
        'clinica_id',
        'paciente_id',
        'usuario_id',
        'numero',
        'fecha',
        'valor',
        'formadepago',
        'observacion',
    ];

    protected $casts = [
        'fecha' => 'date',
        'valor' => 'decimal:2',
    ];
    protected static function booted()
    {
        static::creating(function ($recibo) {

            // Asignar usuario_id automáticamente si hay usuario autenticado
            if (empty($recibo->usuario_id) && auth()->check()) {
                $recibo->user_id = auth()->id();
            }
            

        });
    }
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
    public function facturas()
    {
        return $this->belongsToMany(Factura::class, 'factura_recibos')
            ->withPivot('valor')
            ->withTimestamps();
    }
}
