<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('especialistas', function (Blueprint $table) {
            $table->string("id_servicio")->nullable()->after('deposito');
            $table->string("descripcion")->nullable()->after('id_servicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('especialistas', function (Blueprint $table) {
            $table->dropColumn('id_servicio');
            $table->dropColumn('descripcion');
        });
    }
};