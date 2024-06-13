<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Insertar roles 
        DB::table('roles')->insert([
            'nombre' => 'admin',

        ]);
        // Insertar roles 
        DB::table('roles')->insert([
            'nombre' => 'constructor',

        ]);
                // Insertar roles 
        DB::table('roles')->insert([
            'nombre' => 'logistica',

        ]);
        // Puedes agregar más roles aquí si es necesario
    }
}

