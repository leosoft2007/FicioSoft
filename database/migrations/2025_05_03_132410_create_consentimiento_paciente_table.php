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
        Schema::create('consentimiento_pacientes', function (Blueprint $table) {
            $table->id();

        // Relaciones
        $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
        $table->foreignId('consentimiento_id')->constrained()->onDelete('cascade');

        // Datos de firma digital
        $table->text('firma')->nullable()->comment('SVG de la firma');
        $table->json('firma_biometrica')->nullable()->comment('Datos de presión/velocidad');
        $table->json('hash_documento', 64)->comment('SHA256 del contenido original');

        // Metadatos de auditoría
        $table->json('dispositivo')->comment('Tipo, SO, navegador');
        $table->string('ip_firma', 45)->comment('IPv4/IPv6');

        $table->string('ubicacion')->nullable()->comment('Coordenadas GPS');

        // Validación temporal
        $table->timestamp('firmado_en')->nullable();
        $table->timestamp('invalidado_en')->nullable();

        $table->timestamps();

        // Índices
        $table->index(['paciente_id', 'consentimiento_id']);
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consentimiento_pacientes');
    }
};
