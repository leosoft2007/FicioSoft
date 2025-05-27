<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Scopes\ClinicaScope;
use App\Traits\BelongsToClinica;

class TipoGasto extends Model
{
    /** @use HasFactory<\Database\Factories\TipoGastoFactory> */
    use HasFactory;
    use HasAuditable;
    use HasRoles;

    protected $fillable = [
        'nombre',
        'descripcion',
        'clinica_id',
    ];
    use BelongsToClinica;

    public static $hasClinica = true;
    /**
     * Get the gastos associated with the tipo gasto.
     */
    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }
    /**
     * Get the clinica that owns the tipo gasto.
     */
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }

}
