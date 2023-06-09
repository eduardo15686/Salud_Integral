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
        Schema::table('prospectos', function (Blueprint $table) {
            $table->string('sexo', 20)->after('primera_vez')->nullable();
            $table->string('modalidad', 20)->after('primera_vez')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prospectos', function (Blueprint $table) {
            $table->dropColumn('sexo');
            $table->dropColumn('modalidad');
        });
    }
};