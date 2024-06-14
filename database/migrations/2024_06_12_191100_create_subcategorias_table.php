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
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('Subcategorias');
    }
}
;
