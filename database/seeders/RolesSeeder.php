<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Rol::create(['nombre' => 'Administrador']);
        Rol::create(['nombre' => 'Usuario']);
    }
}
