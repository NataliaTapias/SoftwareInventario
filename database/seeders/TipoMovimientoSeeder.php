<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMovimientoSeeder extends Seeder
{
    public function run()
    {
        $tipoMovimiento = [
            ['nombre' => 'Movimiento Preventivo'],
            ['nombre' => 'Movimiento Correctivo'],
            ['nombre' => 'Movimiento Programable'],
        ];

        DB::table('Tipomovimientos')->insert($tipoMovimiento);
    }
}

