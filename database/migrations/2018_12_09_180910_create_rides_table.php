<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario');
            $table->integer('id_trabajador');
            $table->double('lat_trab');
            $table->double('lng_trab');
            $table->double('lat_serv');
            $table->double('lng_serv');
            $table->integer('tiempo');
            $table->integer('estatus');
            $table->float('calificacion_trab')->nullable();
            $table->float('calificacion_usuario')->nullable();
            $table->text('comentario')->nullable();
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
        Schema::dropIfExists('rides');
    }
}
