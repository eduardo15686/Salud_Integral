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
            $table->string("servicio_id")->nullable()->after('deposito');
            $table->string("descripcion")->nullable()->after('servicio_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('especialistas', function (Blueprint $table) {
            $table->dropColumn('servicio_id');
            $table->dropColumn('descripcion');
        });
    }
};