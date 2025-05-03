<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->date('fecha');
            $table->decimal('total', 10, 2);
            $table->string('estado')->default('pendiente'); // pendiente, pagada, cancelada
            $table->string('metodo_pago')->nullable(); // efectivo, tarjeta, transferencia
            $table->string('numero_factura')->unique();
            $table->string('descripcion')->nullable();
            $table->foreignId('clinica_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
