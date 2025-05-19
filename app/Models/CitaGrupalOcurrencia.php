<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\HasAuditable;
use App\Models\Scopes\ClinicaScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class CitaGrupalOcurrencia extends Model
{
    /** @use HasFactory<\Database\Factories\CitaGrupalOcurrenciaFactory> */
    use HasFactory;
    use HasAuditable;
    use HasRoles;
    protected $fillable = ['fecha', 'hora_inicio', 'hora_fin', 'estado', 'cita_grupal_id', 'clinica_id'];
    

    protected static function booted()
    {
        static::addGlobalScope(new ClinicaScope);

        // Al crear una cita, asignamos automáticamente la clínica del usuario
        static::creating(function ($cita) {
            if (auth()->check()) {
                $cita->clinica_id = auth()->user()->clinica_id;
            }
        });
    }
    public function cuposDisponibles()
    {
        $cupoMaximo = $this->citaGrupal->cupo_maximo ?? 0;
        $ocupados = $this->pacientes()->count();

        return max($cupoMaximo - $ocupados, 0);
    }

    public function citaGrupal()
    {
        return $this->belongsTo(CitaGrupal::class);
    }
    public function citaGrupalPaciente()
    {
        return $this->hasMany(CitaGrupalPaciente::class);
    }
    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }

    // Relacion muchos a muchos con la tabla de pacientes

    public function muchosPacientes(): BelongsToMany
    {
        return $this->belongsToMany(Paciente::class, 'cita_grupal_pacientes', 'cita_grupal_ocurrencia_id', 'paciente_id')
            ->withPivot('clinica_id'); // si quieres acceder a datos extra

    }
    public Function pacientes(): HasMany
    {
        return $this->hasMany(CitaGrupalPaciente::class, 'cita_grupal_ocurrencia_id', 'id');
    }

    public function pacientePuedeAsistir(Paciente $paciente): bool
    {
        $diaSemana = strtolower(\Carbon\Carbon::parse($this->fecha)->locale('es')->isoFormat('ddd')); // 'lun', 'mar', etc.

        return $paciente->disponibles()
            ->where('dia', $diaSemana)
            ->where('hora_inicio', '<=', $this->hora_inicio)
            ->where('hora_fin', '>=', $this->hora_fin)
            ->exists();
    }

    public static function paraCalendario_mysql_ok(int $clinicaId, ?int $profesionalId = null): Collection
    {
        return self::with([
            'citaGrupal.profesional:id,nombre,color',
            'pacientes.paciente:id,nombre,apellido'
        ])
            ->whereHas('citaGrupal', function ($q) use ($clinicaId, $profesionalId) {
                $q->where('clinica_id', $clinicaId);
                if ($profesionalId) {
                    $q->where('profesional_id', $profesionalId);
                }
            })
            ->get()
            ->map(function ($ocurrencia) {
                $nombre = $ocurrencia->citaGrupal->nombre;
                $pacientes = $ocurrencia->pacientes->pluck('paciente')->unique('id');
                $pacienteNombres = $pacientes->map(fn($p) => "{$p->nombre} {$p->apellido}")->join(', ');
                $profesional = $ocurrencia->citaGrupal->profesional->nombre;
                $color = $ocurrencia->citaGrupal->profesional->color ?? '#3b82f6';
                $cupo = $ocurrencia->cuposDisponibles();

                return [
                    'id' => 'grupal-ocurrencia-' . $ocurrencia->id,
                    'nombre' => $nombre,
                    'title' => '👥 ' . $profesional . ' ' . $pacienteNombres,
                    'titleHtml' => "👥 <span style='color:gray;'>$profesional</span> - $pacienteNombres",
                    'tooltipHtml' => "
                    <div class='tooltip-container'>
                        <div class='tooltip-row'>
                            <strong class='tooltip-label'>Grupo:</strong>
                            <span class='tooltip-value'>$nombre</span>
                        </div>
                        <div class='tooltip-row'>
                            <strong class='tooltip-label'>Cupo disponible:</strong>
                            <span class='tooltip-value'>$cupo</span>
                        </div>
                        <div class='tooltip-row'>
                            <strong class='tooltip-label'>Profesional:</strong>
                            <span class='tooltip-value tooltip-professional'>$profesional</span>
                        </div>
                        <div>
                            <strong class='tooltip-patients-title'>Integrantes:</strong>
                            <div class='tooltip-patients'>
                                " . $pacientes->pluck('nombre')->join('<br>') . "
                            </div>
                        </div>
                    </div>",
                    'start' => \Carbon\Carbon::parse($ocurrencia->fecha)->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($ocurrencia->hora_inicio)->format('H:i:s'),
                    'end' => \Carbon\Carbon::parse($ocurrencia->fecha)->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($ocurrencia->hora_fin)->format('H:i:s'),
                    'borderColor' => '#ccc',
                    'classNames' => ['evento-' . $ocurrencia->estado],
                    'extendedProps' => [
                        'tipo' => 'grupal',
                        'observaciones' => $ocurrencia->observaciones,
                        'profesional' => [
                            'color' => $color,
                        ],
                    ],
                ];
            });
    }


    public static function paraCalendario(int $clinicaId, ?int $profesionalId = null): Collection
    {
        $result = self::with([
            'citaGrupal.profesional:id,nombre,color',
            'pacientes.paciente:id,nombre,apellido'
        ])
            ->whereHas('citaGrupal', function ($q) use ($clinicaId, $profesionalId) {
                $q->where('clinica_id', $clinicaId);
                if ($profesionalId) {
                    $q->where('profesional_id', $profesionalId);
                }
            })
            ->get();

        if ($result->isEmpty()) {
            return collect(); // Devuelve una colección vacía si no hay resultados
        }

        return $result->map(function ($ocurrencia) {
            // Validar si las relaciones existen
            if (!$ocurrencia->citaGrupal || !$ocurrencia->citaGrupal->profesional) {
                return []; // O manejarlo como mejor convenga
            }

            $nombre = $ocurrencia->citaGrupal->nombre ?? 'Sin nombre';
            $pacientes = $ocurrencia->pacientes->pluck('paciente')->filter()->unique('id');
            $pacienteNombres = $pacientes->map(fn($p) => "{$p->nombre} {$p->apellido}")->join(', ');
            $profesional = $ocurrencia->citaGrupal->profesional->nombre ?? 'Sin profesional';
            $color = $ocurrencia->citaGrupal->profesional->color ?? '#3b82f6';
            $cupo = $ocurrencia->cuposDisponibles();

            return [
                'id' => 'grupal-ocurrencia-' . $ocurrencia->id,
                'nombre' => $nombre,
                'title' => '👥 ' . $profesional . ' ' . $pacienteNombres,
                'titleHtml' => "👥 <span style='color:gray;'>$profesional</span> - $pacienteNombres",
                'tooltipHtml' => "
            <div class='tooltip-container'>
                <div class='tooltip-row'>
                    <strong class='tooltip-label'>Grupo:</strong>
                    <span class='tooltip-value'>$nombre</span>
                </div>
                <div class='tooltip-row'>
                    <strong class='tooltip-label'>Cupo disponible:</strong>
                    <span class='tooltip-value'>$cupo</span>
                </div>
                <div class='tooltip-row'>
                    <strong class='tooltip-label'>Profesional:</strong>
                    <span class='tooltip-value tooltip-professional'>$profesional</span>
                </div>
                <div>
                    <strong class='tooltip-patients-title'>Integrantes:</strong>
                    <div class='tooltip-patients'>
                        " . $pacientes->pluck('nombre')->join('<br>') . "
                    </div>
                </div>
            </div>",
                'start' => \Carbon\Carbon::parse($ocurrencia->fecha)->format('Y-m-d') . 'T' . ($ocurrencia->hora_inicio ?? '00:00:00'),
                'end' => \Carbon\Carbon::parse($ocurrencia->fecha)->format('Y-m-d') . 'T' . ($ocurrencia->hora_fin ?? '00:00:00'),
                'borderColor' => '#ccc',
                'classNames' => ['evento-' . $ocurrencia->estado],
                'extendedProps' => [
                    'tipo' => 'grupal',
                    'observaciones' => $ocurrencia->observaciones ?? '',
                    'profesional' => [
                        'color' => $color,
                    ],
                ],
            ];
        });
    }
}
