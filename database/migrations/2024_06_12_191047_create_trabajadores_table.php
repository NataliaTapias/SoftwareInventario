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
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('Trabajadores');
    }
}
;
