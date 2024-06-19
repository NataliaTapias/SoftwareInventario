<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'Areas'; // Nombre de la tabla

    protected $primaryKey = 'idArea'; // Nombre de la clave primaria

    // Campos que pueden ser llenados de manera masiva
    protected $fillable = [
        'nombre',
    ];

    // Timestamps
    public $timestamps = true;
}
