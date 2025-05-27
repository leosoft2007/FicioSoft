<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('home');
Route::get('init', [\App\Http\Controllers\ClinicaController::class, 'init'])->name('init');

// Rutas generales de usuario autenticado
Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::redirect('settings', 'settings/profile');
    Livewire\Volt\Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Livewire\Volt\Volt::route('settings/password', 'settings.password')->name('settings.password');
    Livewire\Volt\Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Carga de rutas por módulo
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/clinicas.php';
require __DIR__ . '/especialidades.php';
require __DIR__ . '/profesionales.php';
require __DIR__ . '/pacientes.php';
require __DIR__ . '/facturas.php';
require __DIR__ . '/consentimientos.php';
require __DIR__ . '/grupos.php';
require __DIR__ . '/servicios.php';
require __DIR__ . '/gastos.php';
