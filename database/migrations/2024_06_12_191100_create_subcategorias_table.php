<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('Subcategorias', function (Blueprint $table) {
            $table->increments('idSubcategoria');
            $table->string('nombre', 45);
            $table->unsignedInteger('categorias_id');
            $table->foreign('categorias_id')->references('idCategoria')->on('Categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Subcategorias');
    }
}
;
