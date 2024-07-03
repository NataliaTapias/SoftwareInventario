<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'nombre' => 'Milton Arley Triana Ortiz',
                'cargo' => 'Almacenista',
                'email' => 'milton.triana@quimint.com.co',
                'password' => Hash::make('Milton,1234'),
                'roles_id' => 1, // Rol para ADMIN
            ],
            [
                'nombre' => 'Mantenimiento',
                'cargo' => 'Mantenimento',
                'email' => 'mantenimiento@quimint.com.co',
                'password' => Hash::make('Mantenimiento,1234'),
                'roles_id' => 1, // Rol para ADMIN
            ],
            [
                'nombre' => 'Roland Cerquera Carvajal',
                'cargo' => 'Administrativo',
                'email' => 'roland.cerquera@quimint.com.co',
                'password' => Hash::make('Ronal,1234'),
                'roles_id' => 2, // Rol para Constructor
            ],
            [
                'nombre' => 'Wendy Lorena Perafán Cruz',
                'cargo' => 'Administrativo',
                'email' => 'wendy.perafan@quimint.com.co',
                'password' => Hash::make('Wendy,1234'),
                'roles_id' => 2, // Rol para Constructor
            ],
            [
                'nombre' => 'Yilber Andres Trujillo Tovar',
                'cargo' => 'Administrativo',
                'email' => 'yilber.trujillo@quimint.com.co',
                'password' => Hash::make('Yilber,1234'),
                'roles_id' => 2, // Rol para Constructor
            ],
            [
                'nombre' => 'Samuel Agusto Ramirez O.',
                'cargo' => 'Administrativo',
                'email' => 'samuel.ramirez@quimint.com.co',
                'password' => Hash::make('Samuel,1234'),
                'roles_id' => 2, // Rol para Constructor
            ],
            [
                'nombre' => 'Camilo Alfonso Cano Espinosa',
                'cargo' => 'Administrativo',
                'email' => 'camilo.cano@quimint.com.co',
                'password' => Hash::make('Camilo,1234'),
                'roles_id' => 2, // Rol para Constructor
            ],
            [
                'nombre' => 'Naffi Yannie Cuchimba',
                'cargo' => 'Administrativo',
                'email' => 'naffi.cuchimba@quimint.com.co',
                'password' => Hash::make('Naffi,1234'),
                'roles_id' => 2, // Rol para Constructor
            ],
            [
                'nombre' => 'Andrés Giovanni Andrade',
                'cargo' => 'Logística Combustible',
                'email' => 'andres.andrade@quimint.com.co',
                'password' => Hash::make('Andres,1234'),
                'roles_id' => 3, // Rol para Logística Combustible
            ],
        ];

        DB::table('usuarios')->insert($usuarios);
    }
}
