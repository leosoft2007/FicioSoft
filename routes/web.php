<?php

use App\Http\Controllers\ConsentimientoController;
use App\Http\Controllers\ConsentimientoPacienteController;
use App\Http\Controllers\DisponibleController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FirmaController;
use App\Livewire\Citas\CitaClinica;
use App\Livewire\Facturas\FacturaCreate;
use App\Livewire\Facturas\FacturaIndex;
use App\Livewire\Facturas\FacturaListado;
use App\Livewire\Firma\FirmaPad;
use App\Livewire\Firma\FirmarConsentimiento;
use App\Livewire\Forms\DisponibilidadPaciente;
use App\Livewire\Grupos\CrearCitaGrupal;
use App\Livewire\Grupos\Grupo;
use App\Livewire\Pacientes\DisponibleGrilla;
use App\Livewire\RolesPermissions;
use App\Livewire\TestInput;
use App\Livewire\Users\Create;
use App\Livewire\Users\Index;
use App\Models\ConsentimientoPaciente;
use App\Models\Paciente;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;

// Route::get('/', function () { return view('welcome');})->name('home');
Route::get('/home', function () {
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

Route::get('/clinicas', \App\Livewire\Clinicas\Index::class)->name('clinicas.index');
Route::get('/clinicas/create', \App\Livewire\Clinicas\Create::class)->name('clinicas.create');
Route::get('/clinicas/show/{clinica}', \App\Livewire\Clinicas\Show::class)->name('clinicas.show');
Route::get('/clinicas/update/{clinica}', \App\Livewire\Clinicas\Edit::class)->name('clinicas.edit');
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
Route::get('/agenda', CitaClinica::class)->name('agenda');
// crear factura
Route::get('/facturas/create', FacturaCreate::class)->name('facturas.create');

Route::get('/facturas', FacturaIndex::class)->name('facturas.index');
Route::get('/facturas/{facturaId}/edit', FacturaCreate::class)->name('facturas.edit');

Route::get('/facturas/{id}/pdf', [FacturaCreate::class, 'download'])->name('facturas.pdf');
Route::get('/facturas/listado', FacturaListado::class)->name('facturas.listado');

//firmapad
Route::get('/firmapad', FirmaPad::class)->name('firmapad');
Route::get('/consentimientos', \App\Livewire\Consentimientos\Index::class)->name('consentimientos.index');
Route::get('/consentimientos/create', \App\Livewire\Consentimientos\Create::class)->name('consentimientos.create');
Route::get('/consentimientos/show/{consentimiento}', \App\Livewire\Consentimientos\Show::class)->name('consentimientos.show');
Route::get('/consentimientos/update/{consentimiento}', \App\Livewire\Consentimientos\Edit::class)->name('consentimientos.edit');

// Route::resource('/firma', ConsentimientoPacienteController::class)->names('firma');

Route::get('/pacientes/consentimientos/firmar/{paciente}/{consentimientos}', [ConsentimientoPacienteController::class, 'firmar'])
    ->name('consentimiento.firmar');

    Route::post('/pacientes/{paciente}/consentimientos/{consentimiento}/firmar', [ConsentimientoPacienteController::class, 'store'])
    ->name('consentimiento.store');

    Route::get('/preview-pdf/{id}', [ConsentimientoPacienteController::class, 'generarPdf']);
    // grupos
    Route::get('/grupos', Grupo::class)->name('grupo');
    route::get('/descargarpdf/{id_consentimiento}/{id_paciente}', [ConsentimientoPacienteController::class, 'descargaPdf'])->name('descarga-pdf');

});



require __DIR__.'/auth.php';
