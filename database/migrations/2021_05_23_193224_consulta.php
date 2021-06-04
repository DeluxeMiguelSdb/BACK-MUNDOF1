<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Consulta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta', function (Blueprint $table) {
            $table->id();
            $table->string('param_1_piloto');
            $table->string('param_2_equipo');
            $table->string('param_3_temporada');
            $table->string('param_4_circuito');
            $table->string('param_5_tipoBusqueda');
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
        Schema::dropIfExists('consulta');
    }
}
