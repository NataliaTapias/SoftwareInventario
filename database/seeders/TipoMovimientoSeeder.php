<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMovimientoSeeder extends Seeder
{
    public function run()
    {
        $tipoMovimiento = [
            ['nombre' => 'Movimiento de Entrada'],
            ['nombre' => 'Movimiento de Salida'],
            ['nombre' => 'Ajuste de Entrada'],
            ['nombre' => 'Ajuste de Salida'],
        ];

        DB::table('Tipomovimientos')->insert($tipoMovimiento);
    }
}

