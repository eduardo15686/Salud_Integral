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
        Schema::create('prospectos', function (Blueprint $table) {
            $table->id();
            $table->string('servicios_id');
            $table->string('nombre', 50);
            $table->string('correo', 30);
            $table->string('celular');
            $table->string('edad', 15);
            $table->string('primera_vez', 2);
            $table->string('proceso', 15);
            $table->string('estatus', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospectos');
    }
};
