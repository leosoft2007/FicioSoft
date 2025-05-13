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
        Schema::create('cita_grupal_pacientes', function (Blueprint $table) {

            $table->foreignId('cita_grupal_ocurrencia_id')->constrained('cita_grupal_ocurrencias')->onDelete('cascade');
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->foreignId('clinica_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['cita_grupal_ocurrencia_id', 'paciente_id'], 'cita_grupal_paciente_unique'); // Aquí el nombre es más corto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_grupal_pacientes');
    }
};
