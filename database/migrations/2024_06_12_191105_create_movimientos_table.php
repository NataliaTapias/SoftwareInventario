<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    public function up()
    {
        Schema::create('Movimientos', function (Blueprint $table) {
            $table->increments('idMovimiento');
            $table->dateTime('fecha');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->string('numRemisionProveedor', 45)->nullable();
            $table->text('observacion')->nullable();
            $table->string('firma', 255)->nullable();
            $table->string('proveedor', 255)->nullable();
            $table->string('colaborador', 255)->nullable();
            $table->unsignedInteger('usuarios_id');
            $table->unsignedInteger('solicitudes_id')->nullable(); // Aquí se define como NOT NULL
            $table->unsignedInteger('items_id');
            $table->unsignedInteger('tipoMovimientos_id');
            $table->foreign('usuarios_id')->references('idUsuario')->on('Usuarios');
            $table->foreign('solicitudes_id')->references('idSolicitud')->on('Solicitudes');
            $table->foreign('items_id')->references('idItem')->on('Items');
            $table->foreign('tipoMovimientos_id')->references('idTipomovimiento')->on('Tipomovimientos');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('Movimientos');
    }
};
