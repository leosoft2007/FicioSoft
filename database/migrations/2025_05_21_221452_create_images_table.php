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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('filename')->nullable(); // Nombre del archivo (opcional)
            $table->string('mime_type'); // Tipo MIME (ej: image/jpeg)
            $table->binary('data'); // Contenido de la imagen en formato binario
            $table->unsignedBigInteger('imageable_id'); // ID del modelo relacionado
            $table->string('imageable_type'); // Clase del modelo relacionado
            $table->timestamps();

            // Índices para la relación polimórfica
            $table->index(['imageable_id', 'imageable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
