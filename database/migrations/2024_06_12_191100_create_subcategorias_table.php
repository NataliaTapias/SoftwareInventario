<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->unsignedInteger('categorias_id');
            $table->foreign('categorias_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subcategorias');
    }
}
;
