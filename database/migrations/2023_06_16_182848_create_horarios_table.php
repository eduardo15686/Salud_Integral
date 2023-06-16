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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->integer('especialista_id')->nullable();
            $table->integer('tiempo')->nullable();
            $table->integer('dia')->nullable();
            $table->time('inicio_mat')->nullable();
            $table->time('final_mat')->nullable();
            $table->time('inicio_vesp')->nullable();
            $table->time('final_vesp')->nullable();
            $table->string('estatus', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};