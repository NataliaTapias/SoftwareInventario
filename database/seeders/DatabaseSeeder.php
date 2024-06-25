<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            CategoriasSeeder::class,
            UsuariosSeeder::class,
            SubcategoriasSeeder::class,
            EstadosSeeder::class,
            TipoMovimientoSeeder::class,
            TipoMantenimientoSeeder::class,
            AreasSeeder::class,
            TrabajadoresSeeder::class,

        ]);
    }
}
