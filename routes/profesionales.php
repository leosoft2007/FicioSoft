<?php

use App\Livewire\Profesionals\Create;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/profesionals', \App\Livewire\Profesionals\Index::class)->name('profesionals.index');
    Route::get('/profesionals/create', Create::class)->name('profesionals.create');
    Route::get('/profesionals/show/{profesional}', \App\Livewire\Profesionals\Show::class)->name('profesionals.show');
    Route::get('/profesionals/update/{profesional}', \App\Livewire\Profesionals\Edit::class)->name('profesionals.edit');
});
