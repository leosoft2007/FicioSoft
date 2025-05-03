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
        'hora_inicio',
        'hora_fin',
        'fecha',
        'estado',
        'observaciones'
    ];
    protected $casts = [
        'hora_inicio' => 'datetime:H:i:s',
        'hora_fin' => 'datetime:H:i:s',
        'fecha' => 'date:Y-m-d',
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
    
     // Relación inversa con paciente para citas individuales
     public function paciente()
     {
         return $this->belongsTo(Paciente::class);
     }
     // relacion con servicio
        public function servicio()
        {
            return $this->belongsTo(Servicio::class);
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
    
}
