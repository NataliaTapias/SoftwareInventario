<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->text('descripcionFalla');
            $table->string('tiempoEstimado', 45)->nullable();
            $table->unsignedInteger('tipoMantenimientos_id');
            $table->dateTime('fechaInicio')->nullable();
            $table->dateTime('fechaTermina')->nullable();
            $table->boolean('mantenimientoEficiente')->nullable();
            $table->decimal('totalHorasTrabajadas', 5, 2)->nullable();
            $table->decimal('tiempoParada', 5, 2)->nullable();
            $table->text('repuestosUtilizados')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('firmaDirector', 255)->nullable();
            $table->string('firmaGerente', 255)->nullable();
            $table->string('firmaLider', 255)->nullable();
            $table->unsignedInteger('estados_id');
            $table->unsignedInteger('areas_id');
            $table->unsignedInteger('movimientos_id')->nullable();
            $table->foreign('tipoMantenimientos_id')->references('id')->on('tipomantenimientos');
            $table->foreign('estados_id')->references('id')->on('estados');
            $table->foreign('areas_id')->references('id')->on('areas');
            $table->foreign('movimientos_id')->references('id')->on('movimientos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
};
