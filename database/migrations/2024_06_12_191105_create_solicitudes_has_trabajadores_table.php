<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesHasTrabajadoresTable extends Migration
{
    public function up()
    {
        Schema::create('Solicitudes_has_trabajadores', function (Blueprint $table) {
            $table->increments('idSolicitudtrabajadores');
            $table->unsignedInteger('solicitudes_id');
            $table->unsignedInteger('soli_tipoMantenimientos_id');
            $table->unsignedInteger('solicitudes_estados_id');
            $table->unsignedInteger('trabajadores_id');
            $table->foreign('solicitudes_id')->references('idSolicitud')->on('Solicitudes');
            $table->foreign('soli_tipoMantenimientos_id')->references('idTipomantenimiento')->on('TipoMantenimientos');
            $table->foreign('solicitudes_estados_id')->references('idEstado')->on('Estados');
            $table->foreign('trabajadores_id')->references('idTrabajador')->on('Trabajadores');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Solicitudes_has_trabajadores');
    }
};
