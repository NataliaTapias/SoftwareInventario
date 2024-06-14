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
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            

        });
    }

    public function down()
    {
        Schema::dropIfExists('TipoMantenimientos');
    }
};
