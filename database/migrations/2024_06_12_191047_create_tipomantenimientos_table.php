<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoMantenimientosTable extends Migration
{
    public function up()
    {
        Schema::create('TipoMantenimientos', function (Blueprint $table) {
            $table->increments('idTipomantenimiento');
            $table->string('nombre', 80);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('TipoMantenimientos');
    }
};
