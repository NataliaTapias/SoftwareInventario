<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    public function up()
    {
        Schema::create('Solicitudes', function (Blueprint $table) {
            $table->increments('idSolicitud');
            $table->dateTime('fecha');
            $table->text('descripcionFalla');
            $table->string('tiempoEstimado', 45)->nullable();
            $table->unsignedInteger('tipoMantenimientos_id');
            $table->dateTime('fechaInicio')->nullable();
            $table->dateTime('fechaTermina')->nullable();
            $table->boolean('mantenimientoEficiente')->default(false);
            $table->decimal('totalHorasTrabajadas', 5, 2)->nullable();
            $table->decimal('tiempoParada', 5, 2)->nullable();
            $table->json('repuestosUtilizados')->nullable(); // Cambiado a JSON
            $table->json('trabajadoresAsignados')->nullable(); // Añadido para trabajadores
            $table->text('observaciones')->nullable();
            $table->string('firmaDirector', 255)->nullable();
            $table->string('firmaGerente', 255)->nullable();
            $table->string('firmaLider', 255)->nullable();
            $table->unsignedInteger('estados_id');
            $table->unsignedInteger('areas_id');
            $table->foreign('tipoMantenimientos_id')->references('idTipomantenimiento')->on('Tipomantenimientos');
            $table->foreign('estados_id')->references('idEstado')->on('Estados');
            $table->foreign('areas_id')->references('idArea')->on('Areas');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('Solicitudes');
    }
};
