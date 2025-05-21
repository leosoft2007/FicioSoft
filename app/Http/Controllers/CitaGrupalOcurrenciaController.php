<?php

namespace App\Http\Controllers;

use App\Models\CitaGrupalOcurrencia;
use App\Http\Requests\StoreCitaGrupalOcurrenciaRequest;
use App\Http\Requests\UpdateCitaGrupalOcurrenciaRequest;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\CitaGrupal;



class CitaGrupalOcurrenciaController extends Controller
{
    function generarOcurrencias(CitaGrupal $citaGrupal)
    {
        $fechaInicio = Carbon::parse($citaGrupal->fecha_inicio);
        $fechaFin = Carbon::parse($citaGrupal->fecha_fin);
        $diaSemana = $citaGrupal->dia_semana;

        $frecuenciaDias = $citaGrupal->frecuencia === 'quincenal' ? 14 : 7;

        $fechaActual = $fechaInicio->copy()->next($diaSemana); // primer día correspondiente

        while ($fechaActual->lte($fechaFin)) {
            CitaGrupalOcurrencia::create([
                'cita_grupal_id' => $citaGrupal->id,
                'fecha' => $fechaActual->toDateString(),
                'hora_inicio' => $citaGrupal->hora_inicio,
                'hora_fin' => $citaGrupal->hora_fin,
            ]);

            $fechaActual->addDays($frecuenciaDias);
        }
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCitaGrupalOcurrenciaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CitaGrupalOcurrencia $citaGrupalOcurrencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CitaGrupalOcurrencia $citaGrupalOcurrencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCitaGrupalOcurrenciaRequest $request, CitaGrupalOcurrencia $citaGrupalOcurrencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CitaGrupalOcurrencia $citaGrupalOcurrencia)
    {
        //
    }
}
