<?php

namespace App\Models;

use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ConsentimientoPaciente extends Model
{
    use HasFactory;
    use HasRoles;
    use HasAuditable;
    protected $fillable = [
        'paciente_id',
        'consentimiento_id',
        'firma',
        'firmado_en',
        'invalidado_en',
        'firma_biometrica',
        'dispositivo',
        'hash_documento',
        'ip_firma',
        'ubicacion'
    ];

    protected $casts = [
        'firma_biometrica' => 'array',
        'dispositivo' => 'array',
        'firmado_en' => 'datetime',
        'invalidado_en' => 'datetime'
    ];

    // Relaciones
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function consentimiento()
    {
        return $this->belongsTo(Consentimiento::class);
    }

    // Helpers
    public function esValido()
    {
        return $this->firmado_en && !$this->invalidado_en;
    }

    public function registrarFirma($svg, $biometricos)
    {
        $this->update([
            'firma' => $svg,
            'firma_biometrica' => $biometricos,
            'firmado_en' => now()
        ]);
    }
    
}
