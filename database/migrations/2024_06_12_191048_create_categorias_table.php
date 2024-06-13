<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('Categorias', function (Blueprint $table) {
            $table->increments('id_categoria');
            $table->string('nombre', 45);
            $table->string('tipo', 45);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Categorias');
    }
};
