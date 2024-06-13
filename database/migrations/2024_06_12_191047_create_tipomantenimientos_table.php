<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoMantenimientosTable extends Migration
{
    public function up()
    {
        Schema::create('Tipomantenimientos', function (Blueprint $table) {
            $table->increments('id_tipomante');
            $table->string('nombre', 45);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Tipomantenimientos');
    }
};
