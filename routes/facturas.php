<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Facturas\FacturaCreate;
use App\Livewire\Facturas\FacturaIndex;
use App\Livewire\Facturas\FacturaListado;

Route::middleware(['auth'])->group(function () {
    // Crear y listar facturas
    Route::get('/facturas/create', FacturaCreate::class)->name('facturas.create');
    Route::get('/facturas', FacturaIndex::class)->name('facturas.index');
    Route::get('/facturas/{facturaId}/edit', FacturaCreate::class)->name('facturas.edit');
    Route::get('/facturas/{id}/pdf', [FacturaCreate::class, 'download'])->name('facturas.pdf');
    Route::get('/facturas/listado', FacturaListado::class)->name('facturas.listado');
});
