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
        Schema::table('factura_detalles', function (Blueprint $table) {
            $table->decimal('iva_porcentaje', 5, 2)->default(0)->after('iva');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factura_detalles', function (Blueprint $table) {
            $table->dropColumn('iva_porcentaje');
        });
    }
};
