<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Disponible extends Model
{
    /** @use HasFactory<\Database\Factories\DisponibleFactory> */
    use HasFactory;
    use HasRoles;
    use Auditable;

    protected $fillable = [
        'paciente_id',
        'dia',
        'hora_inicio',
        'hora_fin',
    ];
    protected $casts = [
        'hora_inicio' => 'datetime:H:i',
        'hora_fin' => 'datetime:H:i',
    ];
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    
}
