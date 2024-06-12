<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        Usuario::create([
            'nombre' => 'Admin',
            'cargo' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Cambia la contraseña según lo necesario
            'roles_id' => 1, // Asegúrate de que el rol admin tenga el ID 1
        ]);
    }
}
