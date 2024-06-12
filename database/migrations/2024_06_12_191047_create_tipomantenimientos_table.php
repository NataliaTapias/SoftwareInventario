<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoMantenimientosTable extends Migration
{
    public function up()
    {
        Schema::create('tipomantenimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipomantenimientos');
    }
};
