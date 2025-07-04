<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\BelongsToClinica;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Consentimiento extends Model
{
     use HasFactory;
    use HasRoles;
    use HasAuditable;

    use BelongsToClinica;

    public static $hasClinica = true;


    protected $fillable = [
        'titulo',
        'contenido',
        'tipo', // general, clinica, profesional
        'clinica_id',
    ];

    public function pacientes()
            {
                return $this->belongsToMany(Paciente::class, 'consentimiento_pacientes', 'consentimiento_id', 'paciente_id')
                    ->withPivot('firma', 'firmado_en')
                    ->withTimestamps();

            }
    public function consentimientoPacientes()
    {
        return $this->hasMany(ConsentimientoPaciente::class);
    }
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }


}
