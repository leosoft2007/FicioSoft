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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->nullable()->constrained('pacientes')->onDelete('cascade'); // Cita individual
            $table->foreignId('clinica_id')->constrained('clinicas')->onDelete('cascade');
            $table->foreignId('profesional_id')->constrained('profesionals')->onDelete('cascade');
            $table->foreignId('servicio_id')->nullable()->constrained('servicios');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->date('fecha');
            $table->string('tipo')->default('individual'); // individual, grupal
            $table->string('estado')->default('pendiente'); // pendiente, confirmado, cancelado
            $table->longText('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
