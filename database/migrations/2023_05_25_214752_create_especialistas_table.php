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
        Schema::create('especialistas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nombre', 50)->nullable();
            $table->string('apellido_pat', 30)->nullable();
            $table->string('apellido_mat', 30)->nullable();
            $table->string('titulo', 50)->nullable();
            $table->string('celular')->nullable();
            $table->string('correo', 50)->nullable();
            $table->float('deposito', 8, 2)->nullable();
            $table->string('slug', 40)->nullable();
            $table->string('estatus', 25);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especialistas');
    }
};
