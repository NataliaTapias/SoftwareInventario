<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Consumo'],
            ['nombre' => 'Devolutivo'],
            ['nombre' => 'Combustible'],
        ];

        DB::table('categorias')->insert($categorias);
    }
}
