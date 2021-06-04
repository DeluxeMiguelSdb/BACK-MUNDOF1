<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apuestas', function (Blueprint $table) {
            $table->id();
            $table->integer('idCarrera');
            $table->string('nombreCarrera');
            $table->string('primerPiloto');
            $table->string('segundoPiloto');
            $table->string('tercerPiloto');
            $table->string('equipoGanador');
            $table->boolean('safetyCar');
            $table->boolean('esCorrecta')->nullable();
            $table->foreignId('users_id')->references('id')->on('users');
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
        Schema::dropIfExists('apuestas');
    }
}
