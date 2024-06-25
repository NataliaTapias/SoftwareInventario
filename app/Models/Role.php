<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    use HasFactory;

    protected $table = 'Roles'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'idRol'; // Clave primaria de la tabla

    protected $fillable = [
        'nombre',
        // Agrega aquí los demás campos de tu tabla roles si los hay
    ];

    // Relaciones si las tienes
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'roles_id', 'idRol');
    }
}
