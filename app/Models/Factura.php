<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Factura extends Model
{
    use HasFactory;
    use HasAuditable;
    use HasRoles;

    protected static function booted()
    {
        static::addGlobalScope(new ClinicaScope);

        static::creating(function ($registro) {
            if (auth()->check()) {
                $registro->clinica_id = auth()->user()->clinica_id;
            }

            // Generar número de factura secuencial por clínica
            if (empty($registro->numero_factura) && $registro->clinica_id) {
                $ultimoNumero = self::withoutGlobalScope(ClinicaScope::class)
                    ->where('clinica_id', $registro->clinica_id)
                    ->orderByDesc('id')
                    ->value('numero_factura');

                $nuevoNumero = self::generarNumeroSecuencial($ultimoNumero);

                $registro->numero_factura = $nuevoNumero;
            }
        });

        static::updating(function ($factura) {
            // Incrementar campo rectificada
            $factura->rectificada = ($factura->rectificada ?? 0) + 1;

            // Registrar la fecha de rectificación
            $factura->fecha_rectificacion = now();
        });
    }


protected static function generarNumeroSecuencial($ultimoNumero)
{
    if (!$ultimoNumero) {
        return 'F000001';
    }

    // Extrae número, ignorando prefijo si existe
    $numero = (int) filter_var($ultimoNumero, FILTER_SANITIZE_NUMBER_INT);
    $nuevo = $numero + 1;

    return 'F' . str_pad($nuevo, 6, '0', STR_PAD_LEFT); // Ejemplo: F000124
}

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
