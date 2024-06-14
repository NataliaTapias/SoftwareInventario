<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    public function run()
    {
        // Estados de tipo "item"
        $estadosItems = [
            ['nombre' => 'Disponible', 'tipo' => 'item'],
            ['nombre' => 'Agotado', 'tipo' => 'item'],
            ['nombre' => 'Mínimo', 'tipo' => 'item'],
        ];

        // Estados de tipo "solicitud"
        $estadosSolicitudes = [
            ['nombre' => 'Aprobado', 'tipo' => 'solicitud'],
            ['nombre' => 'No Aprobado', 'tipo' => 'solicitud'],
        ];

        // Insertar estados de tipo "item"
        DB::table('estados')->insert($estadosItems);

        // Insertar estados de tipo "solicitud"
        DB::table('estados')->insert($estadosSolicitudes);
    }
}
