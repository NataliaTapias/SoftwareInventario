<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesHasTrabajadoresTable extends Migration
{
    public function up()
    {
        Schema::create('Solicitudes_has_trabajadores', function (Blueprint $table) {
            $table->increments('id_soli_trabajadores');
            $table->unsignedInteger('solicitudes_id');
            $table->unsignedInteger('soli_tipoMantenimientos_id');
            $table->unsignedInteger('solicitudes_estados_id');
            $table->unsignedInteger('trabajadores_id');
            $table->foreign('solicitudes_id')->references('id_solicitud')->on('Solicitudes');
            $table->foreign('soli_tipoMantenimientos_id')->references('id_tipomante')->on('Tipomantenimientos');
            $table->foreign('solicitudes_estados_id')->references('id_estado')->on('Estados');
            $table->foreign('trabajadores_id')->references('id_trabajador')->on('Trabajadores');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Solicitudes_has_trabajadores');
    }
};
