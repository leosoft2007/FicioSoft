<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/gastos', \App\Livewire\Gastos\Index::class)->name('gastos.index');
    Route::get('/gastos/create', \App\Livewire\Gastos\Create::class)->name('gastos.create');
    Route::get('/gastos/show/{gasto}', \App\Livewire\Gastos\Show::class)->name('gastos.show');
    Route::get('/gastos/update/{gasto}', \App\Livewire\Gastos\Edit::class)->name('gastos.edit');
});
