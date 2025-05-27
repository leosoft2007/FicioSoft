<?php

namespace App\Models;

use App\Models\Scopes\ClinicaScope;
use App\Traits\BelongsToClinica;
use App\Traits\HasAuditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Cita extends Model
{
    use HasFactory;
    use HasAuditable;
    use HasRoles;
    use BelongsToClinica;
    public static $hasClinica = true;

    /** @use HasFactory<\Database\Factories\CitaFactory> */

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
    public static function paraCalendario_mysql_ok(int $clinicaId, ?int $profesionalId = null): \Illuminate\Support\Collection
    {
        return self::with([
            'paciente:id,nombre,apellido',
            'profesional:id,nombre,color'
        ])
            ->select([
                'id',
                'paciente_id',
                'profesional_id',
                'fecha',
                'hora_inicio',
                'hora_fin',
                'observaciones',
                'estado',
                'tipo',
                'clinica_id'
            ])
            ->where('clinica_id', $clinicaId)
            ->when($profesionalId, fn($q) => $q->where('profesional_id', $profesionalId))
            ->get()
            ->map(function ($cita) {
                $pacienteNombre = $cita->paciente?->nombre . ' ' . $cita->paciente?->apellido;
                $profesionalNombre = $cita->profesional?->nombre;
                $color = $cita->profesional?->color ?? '#3b82f6';

                return [
                    'id' => $cita->id,
                    'title' => '👤 ' . $profesionalNombre,
                    'titleHtml' => "👤  <span style='color:gray;'>$profesionalNombre</span> - $pacienteNombre",
                    'tooltipHtml' => "
                        <div class='tooltip-container' style='font-size: 14px; line-height: 1.5; color: #333;'>
                            <strong>Cita Individual</strong> <br>
                            <strong>Profesional:</strong> $profesionalNombre<br>
                            <strong>Pacientes:</strong><br>- $pacienteNombre
                        </div>",
                    'start' => $cita->fecha->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i:s'),
                    'end' => $cita->fecha->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($cita->hora_fin)->format('H:i:s'),
                    'borderColor' => '#ccc',
                    'classNames' => ['evento-' . $cita->estado],
                    'extendedProps' => [
                        'tipo' => $cita->tipo,
                        'observaciones' => $cita->observaciones,
                        'profesional' => [
                            'color' => $color,
                        ],
                    ],
                ];
            });
    }
    public static function paraCalendario(int $clinicaId, ?int $profesionalId = null): \Illuminate\Support\Collection
    {
        return self::with([
            'paciente:id,nombre,apellido',
            'profesional:id,nombre,color'
        ])
            ->select([
                'id',
                'paciente_id',
                'profesional_id',
                'fecha',
                'hora_inicio',
                'hora_fin',
                'observaciones',
                'estado',
                'tipo',
                'clinica_id'
            ])
            ->where('clinica_id', $clinicaId)
            ->when($profesionalId, fn($q) => $q->where('profesional_id', $profesionalId))
            ->get()
            ->map(function ($cita) {
                $pacienteNombre = $cita->paciente?->nombre . ' ' . $cita->paciente?->apellido;
                $profesionalNombre = $cita->profesional?->nombre;
                $color = $cita->profesional?->color ?? '#3b82f6';

                return [
                    'id' => $cita->id,
                    'title' => '👤 ' . $profesionalNombre,
                    'titleHtml' => "👤  <span style='color:gray;'>$profesionalNombre</span> - $pacienteNombre",
                    'tooltipHtml' => "
                    <div class='tooltip-container' style='font-size: 14px; line-height: 1.5; color: #333;'>
                        <strong>Cita Individual</strong> <br>
                        <strong>Profesional:</strong> $profesionalNombre<br>
                        <strong>Pacientes:</strong><br>- $pacienteNombre
                    </div>",
                    'start' => $cita->fecha->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i:s'),
                    'end' => $cita->fecha->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($cita->hora_fin)->format('H:i:s'),
                    'borderColor' => '#ccc',
                    'classNames' => ['evento-' . $cita->estado],
                    'extendedProps' => [
                        'tipo' => $cita->tipo,
                        'observaciones' => $cita->observaciones,
                        'profesional' => [
                            'color' => $color,
                        ],
                    ],
                ];
            })->values(); // Asegúrate de limpiar los índices y devolver una colección válida
    }
}
