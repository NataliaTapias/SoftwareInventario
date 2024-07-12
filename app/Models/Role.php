<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'Roles'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idRol'; // Llave primaria
    public $timestamps = true; // Si tu tabla tiene las columnas created_at y updated_at

    protected $fillable = [
        'nombre'
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'roles_id', 'idRol');
    }
}

