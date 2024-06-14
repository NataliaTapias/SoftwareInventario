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
            $table->foreign('tipoMantenimientos_id')->references('idTipomantenimiento')->on('Tipomantenimientos');
            $table->foreign('estados_id')->references('idEstado')->on('Estados');
            $table->foreign('areas_id')->references('idArea')->on('Areas');
            $table->foreign('movimientos_id')->references('idMovimiento')->on('Movimientos');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('Solicitudes');
    }
};
