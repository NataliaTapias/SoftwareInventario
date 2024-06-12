<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoMovimientosTable extends Migration
{
    public function up()
    {
        Schema::create('tipomovimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipomovimientos');
    }
};
