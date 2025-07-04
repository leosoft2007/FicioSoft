<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\HasAuditable;
use App\Models\Scopes\ClinicaScope;
use App\Traits\BelongsToClinica;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CitaGrupal extends Model
{
    use HasFactory;
    use HasAuditable;
    use HasRoles;
    protected $fillable = [
        'clinica_id',
        'profesional_id',
        'hora_inicio',
        'hora_fin',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'frecuencia',
        'cupo_maximo',
        'dias_semana',
        'nombre',
    ];
    protected $casts = [
        'dias_semana' => 'array',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    use BelongsToClinica;

    public static $hasClinica = true;

    protected static function booted()
    {
        parent::booted();

        // Generar ocurrencias después de crear la cita grupal
        static::created(function ($cita) {
            $cita->generarOcurrencias();
        });

        // Validación personalizada
        static::saving(function ($cita) {
            if (!empty($cita->fecha_fin) && \Carbon\Carbon::parse($cita->fecha_fin)->lessThan(\Carbon\Carbon::parse($cita->fecha_inicio))) {
                throw new \Exception("La fecha de fin no puede ser menor que la de inicio.");
            }
        });
    }


    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }

    public function pacientesIndirectos()
    {
        return $this->ocurrencias()
            ->with('pacientes.paciente') // asegúrate que esté bien la relación
            ->get()
            ->flatMap(function ($ocurrencia) {
                return $ocurrencia->pacientes->pluck('paciente');
            })
            ->unique('id')
            ->values();
    }

    public function pacientes()
    {
        return $this->hasManyThrough(
            Paciente::class,
            CitaGrupalOcurrencia::class,
            'cita_grupal_id', // Foreign key en cita_grupal_ocurrencias
            'id',             // Foreign key en pacientes
            'id',             // Local key en cita_grupals
            'id'              // Local key en cita_grupal_ocurrencias
        )
            ->join('cita_grupal_pacientes', 'cita_grupal_pacientes.cita_grupal_ocurrencia_id', '=', 'cita_grupal_ocurrencias.id')
            ->whereColumn('cita_grupal_pacientes.paciente_id', '=', 'pacientes.id')
            ->distinct();
    }

    public function ocurrencias()
    {
        return $this->hasMany(CitaGrupalOcurrencia::class);
    }

    public function citaGrupalOcurrencias()
    {
        return $this->hasMany(CitaGrupalOcurrencia::class);
    }

    /**
     * Generar automáticamente las ocurrencias a partir de la cita grupal.
     */
    public function generarOcurrencias()
    {
          $dias = $this->dias_semana; // [1, 3, 5] por ejemplo
        //dd($dias);
        //$dias = is_array($this->dias_semana) ? $this->dias_semana : json_decode($this->dias_semana, true) ?? [];
        $fecha = Carbon::parse($this->fecha_inicio)->startOfWeek();
        $fechaFin = $this->fecha_fin ? Carbon::parse($this->fecha_fin) : $fecha->copy()->addMonth();
        $intervalo = $this->frecuencia === 'quincenal' ? 2 : 1;

        while ($fecha->lessThanOrEqualTo($fechaFin)) {
            foreach ($dias as $diaIso) {
                $diaFecha = $fecha->copy()->addDays($diaIso - 1);
                if ($diaFecha->between($this->fecha_inicio, $fechaFin)) {
                    $this->citaGrupalOcurrencias()->create([
                        'fecha' => $diaFecha->toDateString(),
                        'hora_inicio' => $this->hora_inicio,
                        'hora_fin' => $this->hora_fin,
                        'estado' => 'pendiente',
                        'clinica_id' => $this->clinica_id,
                    ]);
                }
            }
            $fecha->addWeeks($intervalo);
        }
    }
    public function asignarPacientes_anterior(array $pacientesIds)
    {
          foreach ($this->ocurrencias as $ocurrencia) {
             $datos = collect($pacientesIds)->map(fn($id) => ['paciente_id' => $id])->all();
             $ocurrencia->pacientes()->createMany($datos);
         }

    }

    public function asignarPacientes(array $pacientesIds)
    {
        //id de clinica
        $clinicaId = $this->clinica_id;
        foreach ($this->ocurrencias as $ocurrencia) {
            $datos = collect($pacientesIds)->map(fn($id) => [
                'paciente_id' => $id,
                'cita_grupal_ocurrencia_id' => $ocurrencia->id,
                'clinica_id' => $clinicaId,
                'created_at' => now(),
                'updated_at' => now(),
            ])->all();

            DB::table('cita_grupal_pacientes')->insert($datos);
        }
    }

    public function pacientesCompatibles()
    {
        $pacientes = Paciente::with('disponibles')->get();

        return $pacientes->filter(function ($paciente) {
            foreach ($this->ocurrencias as $ocurrencia) {
                if ($ocurrencia->cuposDisponibles() > 0 && $ocurrencia->pacientePuedeAsistir($paciente)) {
                    return true;
                }
            }
            return false;
        })->values(); // resetear índices
    }
}


