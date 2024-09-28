<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMovimientoSeeder extends Seeder
{
    public function run()
    {
        $tipoMovimiento = [
            ['nombre' => 'Movimiento de Entrada', 'Operacion' => 1],
            ['nombre' => 'Movimiento de Salida', 'Operacion' => 0],
            ['nombre' => 'Ajuste de Entrada', 'Operacion' => 1],
            ['nombre' => 'Ajuste de Salida', 'Operacion' => 0],
        ];

        DB::table('Tipomovimientos')->insert($tipoMovimiento);
    }
}

