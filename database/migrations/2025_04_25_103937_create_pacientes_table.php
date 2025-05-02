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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('estado')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('pais')->nullable();
            $table->string('genero')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->string('numero_documento')->nullable();
            $table->string('telefono_emergencia')->nullable();
            $table->string('nombre_contacto_emergencia')->nullable();
            $table->string('alergias')->nullable();
            $table->string('medicamentos')->nullable();
            $table->string('historial_medico')->nullable();
            $table->string('notas')->nullable();
            $table->string('foto')->nullable();
            $table->string('estado_paciente')->default('activo'); // activo, inactivo, suspendido
            $table->string('tipo_paciente')->default('regular'); // regular, VIP, urgente
            $table->string('referido_por')->nullable();
            $table->foreignId('clinica_id')->nullable()->constrained('clinicas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
