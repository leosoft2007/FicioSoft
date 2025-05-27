<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Users\Index as UsersIndex;
use App\Livewire\Users\Create as UsersCreate;
use App\Livewire\Users\Show as UsersShow;
use App\Livewire\Users\Edit as UsersEdit;
use App\Livewire\RolesPermissions;
use App\Livewire\Clinicas\Index as ClinicasIndex;
use App\Livewire\Clinicas\Create as ClinicasCreate;
use App\Livewire\Clinicas\Show as ClinicasShow;
use App\Livewire\Clinicas\Edit as ClinicasEdit;

Route::middleware(['auth', 'role:Administrador'])->group(function () {
    // Usuarios
    Route::get('/users', UsersIndex::class)->name('users.index');
    Route::get('/users/create', UsersCreate::class)->name('users.create');
    Route::get('/users/show/{user}', UsersShow::class)->name('users.show');
    Route::get('/users/update/{user}', UsersEdit::class)->name('users.edit');
    Route::get('/roles-permissions', RolesPermissions::class)->name('roles-permissions');

    // Clínicas
    Route::get('/clinicas', ClinicasIndex::class)->name('clinicas.index');
    Route::get('/clinicas/create', ClinicasCreate::class)->name('clinicas.create');
    Route::get('/clinicas/show/{clinica}', ClinicasShow::class)->name('clinicas.show');
    Route::get('/clinicas/update/{clinica}', ClinicasEdit::class)->name('clinicas.edit');
});
