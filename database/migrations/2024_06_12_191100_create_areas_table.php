<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    public function up()
    {
        Schema::create('Areas', function (Blueprint $table) {
            $table->increments('id_area');
            $table->string('nombre', 45);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Areas');
    }
};
