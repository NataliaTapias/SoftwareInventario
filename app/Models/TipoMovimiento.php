<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model
{
    protected $table = 'Tipomovimientos';
    protected $primaryKey = 'idTipomovimiento';

    protected $fillable = [
        'nombre',
        'Operacion',
    ];

    public $timestamps = true;
}
