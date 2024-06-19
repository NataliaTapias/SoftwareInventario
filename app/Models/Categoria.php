<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'Categorias'; // Nombre de la tabla

    protected $primaryKey = 'idCategoria'; // Nombre de la clave primaria

    // Campos que pueden ser llenados de manera masiva
    protected $fillable = [
        'nombre',
    ];

    // Timestamps
    public $timestamps = true;
}
