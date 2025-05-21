<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * migracion de la tabla auditable de auditoria
     * Esta tabla se utiliza para almacenar los registros de auditoria
     * de los modelos que implementan la interfaz Auditable.
     * Los campos son:
     * - id: identificador unico del registro de auditoria
     * - event: tipo de evento (create, update, delete)
     * - auditable_type: tipo de modelo que se audita
     * - auditable_id: id del modelo que se audita
     * - user_id: id del usuario que realiza la accion
     * - user_type: tipo de usuario que realiza la accion
     * - url: url de la peticion
     * - ip_address: direccion ip del usuario que realiza la accion
     * - old: datos antiguos del modelo (en caso de update o delete)
     * - created_at: fecha de creacion del registro de auditoria
     */
    public function up(): void
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->string('auditable_type');
            $table->unsignedBigInteger('auditable_id');
            $table->nullableMorphs('user');
            $table->string('url')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->json('old')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
