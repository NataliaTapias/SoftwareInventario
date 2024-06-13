<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoMovimientosTable extends Migration
{
    public function up()
    {
        Schema::create('Tipomovimientos', function (Blueprint $table) {
            $table->increments('idTipomovimiento');
            $table->string('nombre', 45);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Tipomovimientos');
    }
};
