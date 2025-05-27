<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pacientes\DisponibleGrilla;
use App\Livewire\Forms\DisponibilidadPaciente;

Route::middleware(['auth'])->group(function () {
    Route::get('/pacientes', \App\Livewire\Pacientes\Index::class)->name('pacientes.index');
    Route::get('/pacientes/create', \App\Livewire\Pacientes\Create::class)->name('pacientes.create');
    Route::get('/pacientes/show/{paciente}', \App\Livewire\Pacientes\Show::class)->name('pacientes.show');
    Route::get('/pacientes/update/{paciente}', \App\Livewire\Pacientes\Edit::class)->name('pacientes.edit');

    // Disponibilidad
    Route::get('/disponibilidad/{id}', DisponibilidadPaciente::class)->name('disponibilidad');
    Route::get('/disponibilidad/{id}/ver/', [DisponibilidadPaciente::class, 'ver'])->name('ver_disponibilidad');
    Route::get('/agenda', \App\Livewire\Citas\CitaClinica::class)->name('agenda');
});
