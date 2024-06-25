<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $table = 'Trabajadores'; // Especifica la tabla
    protected $primaryKey = 'idTrabajador'; // Especifica la clave primaria

    protected $fillable = [
        'nombre',
        // Agrega otros campos que sean necesarios para tu modelo
    ];

    public $timestamps = false; // Si no usas timestamps, asegúrate de declararlo
}
