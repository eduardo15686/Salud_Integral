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
        Schema::table('agendas', function (Blueprint $table) {
            $table->string('dia', 20)->after('prospecto_id')->nullable();
            $table->string('tiempo', 20)->after('prospecto_id')->nullable();
            $table->string('estatus', 20)->after('hora')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn('dia');
            $table->dropColumn('tiempo');
            $table->dropColumn('estatus');
        });
    }
};