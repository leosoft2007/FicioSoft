<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\BelongsToClinica;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Disponible extends Model
{
    use HasFactory;
    use HasRoles;
    use HasAuditable;
    use BelongsToClinica;

    public static $hasClinica = true;

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
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }

}
