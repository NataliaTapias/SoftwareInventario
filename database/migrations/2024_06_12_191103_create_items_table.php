<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('referencia', 45);
            $table->string('nombre', 45);
            $table->text('descripcion')->nullable();
            $table->integer('cantidad');
            $table->integer('cantidadMinima');
            $table->string('unidadMedida', 45);
            $table->unsignedInteger('subcategorias_id');
            $table->unsignedInteger('estados_id');
            $table->foreign('subcategorias_id')->references('id')->on('subcategorias')->onDelete('cascade');
            $table->foreign('estados_id')->references('id')->on('estados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
};
