<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class UsuariosTableSeeder extends Seeder
{
    public function run()
    {
        // Insertar usuarios de ejemplo usando el modelo Eloquent
        User::create([
            'nombre' => 'Admin',
            'cargo' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin1234'),
            'roles_id' => 8, // Ajusta según la relación que tengas definida
        ]);


        User::create([
            'nombre' => 'Constructor',
            'cargo' => 'constructor',
            'email' => 'constructor@example.com',
            'password' => Hash::make('constructor123'),
            'roles_id' => 9, // Ajusta según la relación que tengas definida
        ]);

        
        User::create([
            'nombre' => 'Logistica',
            'cargo' => 'logistica',
            'correo' => 'logistica@gmail.com',
            'password' => Hash::make('logistica123'),
            'roles_id' => 10, // Ajusta según la relación que tengas definida
        ]);
    }
}

