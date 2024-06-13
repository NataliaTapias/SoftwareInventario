<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    public function up()
    {
        Schema::create('Movimientos', function (Blueprint $table) {
            $table->increments('id_movimiento');
            $table->dateTime('fecha');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->string('numRemisionProveedor', 45)->nullable();
            $table->text('observacion')->nullable();
            $table->string('firma', 255);
            $table->string('proveedor', 255);
            $table->string('colaborador', 255);
            $table->unsignedInteger('usuarios_id');
            $table->unsignedInteger('items_id');
            $table->unsignedInteger('tipoMovimientos_id');
            $table->foreign('usuarios_id')->references('id_usuario')->on('Usuarios');
            $table->foreign('items_id')->references('id_item')->on('Items');
            $table->foreign('tipoMovimientos_id')->references('id_tipomovimiento')->on('Tipomovimientos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Movimientos');
    }
};
