<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Definir los datos a insertar
        $roles = [
            ['nombre' => 'admin'],
            ['nombre' => 'constructor'],
            ['nombre' => 'logistica'],
            ['nombre' => 'mantenimiento'],
            // Puedes agregar más roles aquí si es necesario
        ];

        // Insertar los roles en la tabla 'roles'
        DB::table('roles')->insert($roles);
    }
}


