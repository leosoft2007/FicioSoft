<?php

namespace App\Livewire\Panel;

use Livewire\Component;
use App\Models\Cita;
use App\Models\Factura;
use App\Models\Paciente;
use App\Models\Profesional;
use App\Models\Servicio;
use Carbon\Carbon;


class Panel extends Component
{
     public $citasHoy;
    public $citasConfirmadasHoy;
    public $facturacionMes;
    public $comparacionFacturacion;
    public $pacientesNuevosMes;
    public $totalPacientes;
    public $profesionalesActivos;
    public $profesionalesDisponibles;
    public $citasPorProfesional;
    public $facturacionServicios;
    public $proximasCitas;
    public $totalProximasCitas;

    public function mount()
    {
        $this->loadStats();
    }

    
    public function loadStats()
    {
        // Citas para hoy
        $this->citasHoy = Cita::whereDate('fecha', today())->count();
        $this->citasConfirmadasHoy = Cita::whereDate('fecha', today())
            ->where('estado', 'confirmado')
            ->count();

        // Facturación mensual
        $this->facturacionMes = Factura::whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year)
            ->sum('total');
        
        $facturacionMesAnterior = Factura::whereMonth('fecha', now()->subMonth()->month)
            ->whereYear('fecha', now()->subMonth()->year)
            ->where('estado', 'pagada')
            ->sum('total');

        $this->comparacionFacturacion = $facturacionMesAnterior > 0 
            ? round((($this->facturacionMes - $facturacionMesAnterior) / $facturacionMesAnterior) * 100)
            : 100;

        // Pacientes
        $this->pacientesNuevosMes = Paciente::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $this->totalPacientes = Paciente::count();

        // Profesionales
        $this->profesionalesActivos = Profesional::all()->count();
        

        // Citas por profesional hoy
       

        $this->citasPorProfesional = Profesional::withCount(['citas' => function($query) {
        $query->whereDate('fecha', today());
    }])
    ->having('citas_count', '>', 0)
    ->orderByDesc('citas_count')
    ->get()
            ->map(function ($profesional) {
                return [
                    'nombre' => $profesional->nombre,
                    'apellido' => $profesional->apellido,
                    'especialidad' => optional($profesional->especialidad)->nombre ?? 'Sin especialidad',
                    'citas_count' => $profesional->citas_count,
                ];
            });

            

        // Facturación por servicio últimos 30 días
        $hace30Dias = now()->subDays(30)->toDateString();

            $this->facturacionServicios = Servicio::whereHas('facturaDetalles', function ($query) use ($hace30Dias) {
                    $query->whereHas('factura', function ($q) use ($hace30Dias) {
                        $q->where('estado', 'pagada')
                        ->where('fecha', '>=', $hace30Dias);
                    });
                })
                ->with(['facturaDetalles' => function ($query) use ($hace30Dias) {
                    $query->whereHas('factura', function ($q) use ($hace30Dias) {
                        $q->where('estado', 'pagada')
                        ->where('fecha', '>=', $hace30Dias);
                    });
                }])
                ->get()
                ->map(function ($servicio) {
                    return [
                        'nombre' => $servicio->nombre,
                        'total' => $servicio->facturaDetalles->sum('total') ?: 0
                    ];
                });

        // Próximas citas (5 más próximas)
        $this->proximasCitas = Cita::with(['paciente', 'profesional', 'servicio'])
            ->where('fecha', '>=', today())
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->limit(5)
            ->get();

        $this->totalProximasCitas = Cita::where('fecha', '>=', today())->count();
    }
    public function render()
    {
      
        return view('livewire.panel.panel');
    }
}
