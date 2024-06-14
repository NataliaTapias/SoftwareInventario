<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrabajadoresSeeder extends Seeder
{
    public function run(): void
    {
        $trabajadores = [
            ['nombre' => 'Cristian Andres Paz Vargas'],
            ['nombre' => 'Edgar Hernan Acuña Galvis'],
            ['nombre' => 'Genaro Cogollo Rojas'],
            ['nombre' => 'Israel Ramirez Alape'],
            ['nombre' => 'Jhon Fredy Reyes Saenz'],
            ['nombre' => 'Jose Mauricio Briñez Alape'],
            ['nombre' => 'Karwin Armando Cuellar Guzman'],
            ['nombre' => 'Marlon David Leiva Silva'],
            ['nombre' => 'Mateo Pinzon Zapata'],
            ['nombre' => 'Santiago Idarra Celemin'],

        ];

        DB::table('trabajadores')->insert($trabajadores);
    }
}
