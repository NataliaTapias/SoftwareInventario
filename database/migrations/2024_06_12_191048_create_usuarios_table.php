<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('Usuarios', function (Blueprint $table) {
            $table->increments('idUsuario');
            $table->string('nombre');
            $table->string('cargo', 45)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('create_time')->useCurrent();
            $table->unsignedInteger('roles_id');
            $table->foreign('roles_id')->references('idRol')->on('Roles'); // Definir la clave foránea correctamente
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
