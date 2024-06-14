<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriasSeeder extends Seeder
{
    public function run()
    {
        $subcategorias = [
            ['nombre' => 'Maquinaria Amarilla', 'categorias_id' => 1],
            ['nombre' => 'Plantas de Producción', 'categorias_id' => 1],
            ['nombre' => 'Estación de Servicio', 'categorias_id' => 1],
            ['nombre' => 'Lubricantes', 'categorias_id' => 1],
            ['nombre' => 'Herramientas', 'categorias_id' => 2],
            ['nombre' => 'Equipos', 'categorias_id' => 2],
            ['nombre' => 'Logística', 'categorias_id' => 3],
        ];

        DB::table('subcategorias')->insert($subcategorias);
    }
}
