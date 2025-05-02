<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Cita extends Model
{
    /** @use HasFactory<\Database\Factories\CitaFactory> */
    use HasFactory;
    use Auditable;
    use HasRoles;
    protected $perPage = 20;

    protected $fillable = [
        'paciente_id',
        'clinica_id',
        'profesional_id',
        'especialidad_id',
        'hora_ini',
        'hora_fin',
        'fecha',
        'estado',
        'observaciones'
    ];
    protected $casts = [
        'fecha' => 'date',
        'hora_ini' => 'datetime',
        'hora_fin' => 'datetime',
    ];
    protected $with = [
        'paciente', 
        'clinica', 
        'profesional', 
        'especialidad', 
        'horaInicio', 
        'horaFin'
    ];
 
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }
    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
    public function horaIni()
    {
        return $this->belongsTo(Hora::class, 'hora_ini');
    }
    public function horaFin()
    {
        return $this->belongsTo(Hora::class, 'hora_fin');
    }

       

     // Relación inversa con paciente para citas individuales
     public function paciente()
     {
         return $this->belongsTo(Paciente::class);
     }
 
     // Relación M:M con pacientes a través de la tabla clases (citas grupales)
     public function clases()
     {
         return $this->belongsToMany(Paciente::class, 'clases', 'cita_id', 'paciente_id');
     }


    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }
    // este scope es para las citas que no han sido confirmadas ni canceladas
    // y que se utiza en el controlador de citas de la siguiente manera:
    // $citas = Cita::Confirmadas()->get();
    
    public function scopeConfirmadas($query)
    {
        return $query->where('estado', 'confirmado');
    }
    
    public function scopeCanceladas($query)
    {
        return $query->where('estado', 'cancelado');
    }
    public function scopeHoy($query)
    {
        return $query->where('fecha', now()->format('Y-m-d'));
    }
    public function scopePasadas($query)
    {
        return $query->where('fecha', '<', now()->format('Y-m-d'));
    }
    public function scopeFuturas($query)
    {
        return $query->where('fecha', '>', now()->format('Y-m-d'));
    }
    public function scopeEntreFechas($query, $fechaInicio, $fechaFin)
    {
        return $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
    }
    public function scopeEntreHoras($query, $horaInicio, $horaFin)
    {
        return $query->whereBetween('hora_ini', [$horaInicio, $horaFin]);
    }
    public function scopeEntreHorasFin($query, $horaInicio, $horaFin)
    {
        return $query->whereBetween('hora_fin', [$horaInicio, $horaFin]);
    }
    public function scopeEntreHorasIniFin($query, $horaInicio, $horaFin)
    {
        return $query->whereBetween('hora_ini', [$horaInicio, $horaFin])
            ->orWhereBetween('hora_fin', [$horaInicio, $horaFin]);
    }
    public function scopeEntreHorasIniFinAndFecha($query, $horaInicio, $horaFin, $fecha)
    {
        return $query->whereBetween('hora_ini', [$horaInicio, $horaFin])
            ->orWhereBetween('hora_fin', [$horaInicio, $horaFin])
            ->where('fecha', $fecha);
    }
    
}
