<?php

use App\Http\Controllers\DisponibleController;
use App\Livewire\Forms\DisponibilidadPaciente;
use App\Livewire\Pacientes\DisponibleGrilla;
use App\Livewire\RolesPermissions;
use App\Livewire\Users\Create;
use App\Livewire\Users\Index;
use App\Models\Paciente;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route::get('/', function () { return view('welcome');})->name('home');
Route::get('/home', function () {
    return redirect('/dashboard');
})->name('home');
Route::get('/', function () {
    return redirect('/dashboard');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth', 'role:Administrador'])->group(function () {
Route::get('/users', Index::class)->name('users.index');
Route::get('/users/create', Create::class)->name('users.create');
Route::get('/users/show/{user}', \App\Livewire\Users\Show::class)->name('users.show');
Route::get('/users/update/{user}', \App\Livewire\Users\Edit::class)->name('users.edit');

Route::get('/roles-permissions', RolesPermissions::class)->name('roles-permissions');
});

Route::middleware(['auth'])->group(function () {
Route::get('/especialidads', \App\Livewire\Especialidads\Index::class)->name('especialidads.index');
Route::get('/especialidads/create', \App\Livewire\Especialidads\Create::class)->name('especialidads.create');
Route::get('/especialidads/show/{especialidad}', \App\Livewire\Especialidads\Show::class)->name('especialidads.show');
Route::get('/especialidads/update/{especialidad}', \App\Livewire\Especialidads\Edit::class)->name('especialidads.edit');

Route::get('/profesionals', \App\Livewire\Profesionals\Index::class)->name('profesionals.index');       
Route::get('/profesionals/create', \App\Livewire\Profesionals\Create::class)->name('profesionals.create');
Route::get('/profesionals/show/{profesional}', \App\Livewire\Profesionals\Show::class)->name('profesionals.show');
Route::get('/profesionals/update/{profesional}', \App\Livewire\Profesionals\Edit::class)->name('profesionals.edit');

Route::get('/pacientes', \App\Livewire\Pacientes\Index::class)->name('pacientes.index');
Route::get('/pacientes/create', \App\Livewire\Pacientes\Create::class)->name('pacientes.create');       
Route::get('/pacientes/show/{paciente}', \App\Livewire\Pacientes\Show::class)->name('pacientes.show');  
Route::get('/pacientes/update/{paciente}', \App\Livewire\Pacientes\Edit::class)->name('pacientes.edit');

Route::get('/disponibilidad/{id}', DisponibilidadPaciente::class)->name('disponibilidad');
Route::get('/disponibilidad/{id}/ver/', [DisponibilidadPaciente::class, 'ver'])->name('ver_disponibilidad');


});



require __DIR__.'/auth.php';
