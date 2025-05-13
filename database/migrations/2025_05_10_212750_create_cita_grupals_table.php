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
        Schema::create('cita_grupals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->default('Clases');
            $table->foreignId('profesional_id')->constrained();
            $table->foreignId('clinica_id')->constrained();
            $table->text('descripcion')->nullable();
            $table->json('dias_semana'); // 1=lunes, ..., 6=sábado
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable(); // hasta cuándo se repite
            $table->enum('frecuencia', ['semanal', 'quincenal'])->default('semanal');
            $table->unsignedTinyInteger('cupo_maximo')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_grupals');
    }
};
