<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesHasTrabajadoresTable extends Migration
{
    public function up()
    {
        Schema::create('solicitudes_has_trabajadores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('solicitudes_id');
            $table->unsignedInteger('soli_tipoMantenimientos_id');
            $table->unsignedInteger('solicitudes_estados_id');
            $table->unsignedInteger('trabajadores_id');
            $table->foreign('solicitudes_id')->references('id')->on('solicitudes');
            $table->foreign('soli_tipoMantenimientos_id')->references('id')->on('tipomantenimientos');
            $table->foreign('solicitudes_estados_id')->references('id')->on('estados');
            $table->foreign('trabajadores_id')->references('id')->on('trabajadores');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes_has_trabajadores');
    }
};
