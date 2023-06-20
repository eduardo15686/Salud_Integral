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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->integer('especialista_id')->nullable();
            $table->string('no_paciente', 15)->nullable();
            $table->string('nombre', 50)->nullable();
            $table->string('correo', 30)->nullable();
            $table->string('celular')->nullable();
            $table->string('edad', 3)->nullable();
            $table->string('sexo', 15)->nullable();
            $table->string('estatus', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};