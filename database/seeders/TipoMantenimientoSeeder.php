<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMantenimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoManteniento = [
            ['nombre' => 'Mantenimiento Preventivo'],
            ['nombre' => 'Mantenimiento Correctivo'],
            ['nombre' => 'Mantenimiento Programable'],

        ];

        DB::table('TipoMantenimientos')->insert($tipoManteniento);
    }
}
