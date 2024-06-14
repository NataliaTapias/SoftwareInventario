<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de importar la clase DB
class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir los datos a insertar
        $area = [
            ['nombre' => 'Sulforico I'],
            ['nombre' => 'Fosforico'],
            ['nombre' => 'Molienda Dolomita'],
            ['nombre' => 'Molienda Roca Fosforica'],
            ['nombre' => 'Sulforico II'],
            ['nombre' => 'DEM'],
            ['nombre' => 'Molino Raymond'],
            ['nombre' => 'Horno I'],
            ['nombre' => 'Horno II'],
        ];

        // Insertar areas en la tabla areas
        DB::table('areas')->insert($area);
    }
}
