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
            $table->foreignId('especialidad_id')->constrained('especialidads')->onDelete('cascade');
            $table->foreignId('hora_ini')->constrained('horas')->onDelete('cascade');
            $table->foreignId('hora_fin')->constrained('horas')->onDelete('cascade');
            $table->date('fecha');
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
