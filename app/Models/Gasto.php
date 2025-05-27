<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Scopes\ClinicaScope;
use App\Traits\BelongsToClinica;

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
    use BelongsToClinica;

    public static $hasClinica = true;
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
