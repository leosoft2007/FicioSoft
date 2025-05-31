<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/recibos', \App\Livewire\Recibos\Index::class)->name('recibos.index');
    Route::get('/recibos/create', \App\Livewire\Recibos\Create::class)->name('recibos.create');
    Route::get('/recibos/show/{recibo}', \App\Livewire\Recibos\Show::class)->name('recibos.show');
    Route::get('/recibos/update/{recibo}', \App\Livewire\Recibos\Edit::class)->name('recibos.edit');
});


