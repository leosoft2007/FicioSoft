<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/servicios', \App\Livewire\Servicios\Index::class)->name('servicios.index');
    Route::get('/servicios/create', \App\Livewire\Servicios\Create::class)->name('servicios.create');
    Route::get('/servicios/show/{servicio}', \App\Livewire\Servicios\Show::class)->name('servicios.show');
    Route::get('/servicios/update/{servicio}', \App\Livewire\Servicios\Edit::class)->name('servicios.edit');
});
