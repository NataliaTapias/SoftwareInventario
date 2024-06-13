<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadoresTable extends Migration
{
    public function up()
    {
        Schema::create('Trabajadores', function (Blueprint $table) {
            $table->increments('idTrabajador');
            $table->string('nombre', 150);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Trabajadores');
    }
}
;
