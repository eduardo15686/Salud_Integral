<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('url')->nullable();
            $table->string('text_html')->nullable();
            $table->string('alt_html')->nullable();
            $table->string('class')->nullable();
            $table->string('function')->nullable();
            $table->string('categoria',20)->nullable();
            $table->integer('orden')->nullable();
            $table->string('origen',20)->nullable();
            $table->string('estatus',20)->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
