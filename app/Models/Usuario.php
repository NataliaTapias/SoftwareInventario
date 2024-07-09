<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'Usuarios'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idUsuario'; // Llave primaria
    public $timestamps = true; // Si tu tabla tiene las columnas created_at y updated_at

    protected $fillable = [
        'nombre', 
        'cargo', 
        'email', 
        'password', 
        'roles_id'
    ];

    public function rol()
    {
        return $this->belongsTo(Role::class, 'roles_id', 'idRol');
    }
    public function hasRole($role)
    {
        return $this->roles_id === $role; // Aquí comparas el campo roles_id con el rol deseado
    }
}
