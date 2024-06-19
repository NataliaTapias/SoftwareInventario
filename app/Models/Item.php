<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'Items'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'idItem'; // Clave primaria de la tabla

    protected $fillable = [
        'referencia',
        'nombre',
        'descripcion',
        'cantidad',
        'cantidadMinima',
        'unidadMedida',
        'subcategorias_id',
        'estados_id',
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'subcategorias_id', 'idSubcategoria');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados_id', 'idEstado');
    }
}
