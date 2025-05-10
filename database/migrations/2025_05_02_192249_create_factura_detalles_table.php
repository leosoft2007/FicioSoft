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
        Schema::create('factura_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_id')->constrained()->onDelete('cascade');
            $table->foreignId('servicio_id')->constrained()->onDelete('cascade');
            $table->foreignId('clinica_id')->constrained('clinicas')->onDelete('cascade');
            $table->string('descripcion');
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('cantidad');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('iva', 10, 2)->default(0); // IVA en porcentaje
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_detalles');
    }
};
