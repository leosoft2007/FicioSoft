<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/grupos', \App\Livewire\Grupos\Grupo::class)->name('grupo');
    // Agrega aquí rutas adicionales de grupos si tienes más
});
