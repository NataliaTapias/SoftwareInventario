<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 255);
            $table->string('cargo', 45)->nullable();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->timestamp('create_time')->useCurrent();
            $table->unsignedInteger('roles_id');
            $table->foreign('roles_id')->references('id')->on('roles');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
