<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMantenimiento extends Model
{
    protected $table = 'TipoMantenimientos'; // Nombre de la tabla
    protected $primaryKey = 'idTipomantenimiento'; // Nombre de la clave primaria
    public $timestamps = true; // Si estás usando timestamps
    
    protected $fillable = ['nombre']; // Campos que se pueden llenar de forma masiva
}
