<?php

namespace App\Http\Controllers;

use App\Models\Disponible;
use App\Http\Requests\StoreDisponibleRequest;
use App\Http\Requests\UpdateDisponibleRequest;
use App\Models\Paciente;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DisponibleController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    
    public function index(int $id)
        {
            
        }
       


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    

    /**
     * Display the specified resource.
     */
    public function show(Disponible $disponible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disponible $disponible)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDisponibleRequest $request, Disponible $disponible)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($pacienteId, $id)
        {
           
        }
}
