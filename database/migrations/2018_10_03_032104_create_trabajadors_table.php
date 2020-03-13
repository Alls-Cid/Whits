<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->bigInteger('telefono');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->integer('actividad');
            $table->integer('categoria');
            $table->string('descripcion');
            $table->integer('experiencia');
            $table->float('calificacion');
            $table->binary('estatus');
            $table->string('img_profile')->nullable();
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
        Schema::dropIfExists('trabajadors');
    }
}
