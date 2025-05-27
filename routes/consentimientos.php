<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsentimientoPacienteController;

Route::middleware(['auth'])->group(function () {
    // Consentimientos
    Route::get('/consentimientos', \App\Livewire\Consentimientos\Index::class)->name('consentimientos.index');
    Route::get('/consentimientos/create', \App\Livewire\Consentimientos\Create::class)->name('consentimientos.create');
    Route::get('/consentimientos/show/{consentimiento}', \App\Livewire\Consentimientos\Show::class)->name('consentimientos.show');
    Route::get('/consentimientos/update/{consentimiento}', \App\Livewire\Consentimientos\Edit::class)->name('consentimientos.edit');

    // Firma de consentimientos por paciente
    Route::get('/pacientes/consentimientos/firmar/{paciente}/{consentimientos}', [ConsentimientoPacienteController::class, 'firmar'])
        ->name('consentimiento.firmar');
    Route::post('/pacientes/{paciente}/consentimientos/{consentimiento}/firmar', [ConsentimientoPacienteController::class, 'store'])
        ->name('consentimiento.store');
    Route::get('/preview-pdf/{id}', [ConsentimientoPacienteController::class, 'generarPdf']);
    Route::get('/descargarpdf/{id_consentimiento}/{id_paciente}', [ConsentimientoPacienteController::class, 'descargaPdf'])->name('descarga-pdf');

    // FirmaPad
    Route::get('/firmapad', \App\Livewire\Firma\FirmaPad::class)->name('firmapad');
});
