<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/especialidads', \App\Livewire\Especialidads\Index::class)->name('especialidads.index');
    Route::get('/especialidads/create', \App\Livewire\Especialidads\Create::class)->name('especialidads.create');
    Route::get('/especialidads/show/{especialidad}', \App\Livewire\Especialidads\Show::class)->name('especialidads.show');
    Route::get('/especialidads/update/{especialidad}', \App\Livewire\Especialidads\Edit::class)->name('especialidads.edit');
});
