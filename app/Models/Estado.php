<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'Estados'; // Nombre de la tabla

    protected $primaryKey = 'idEstado'; // Nombre de la clave primaria

    // Campos que pueden ser llenados de manera masiva
    protected $fillable = [
        'nombre',
    ];

    // Timestamps
    public $timestamps = true;
}
