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
        Schema::table('servicios', function (Blueprint $table) {
            // Eliminar las columnas "color" e "icono"
            $table->dropColumn(['color', 'icono']);

            // Agregar la nueva columna "iva"
            $table->decimal('iva', 3, 2)->after('precio'); // IVA como porcentaje
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            // Volver a agregar las columnas "color" e "icono"
            $table->string('color')->default('#3b82f6');
            $table->string('icono')->default('fa-solid fa-calendar');

            // Eliminar la columna "iva"
            $table->dropColumn('iva');
        });
    }
};
