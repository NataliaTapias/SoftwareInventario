<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'Movimientos';
    protected $primaryKey = 'idMovimiento';

    protected $fillable = [
        'fecha',
        'cantidad',
        'precio',
        'numRemisionProveedor',
        'observacion',
        'firma',
        'proveedor',
        'colaborador',
        'usuarios_id',
        'solicitudes_id',
        'items_id',
        'tipoMovimientos_id'
    ];

    // Definir las relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarios_id', 'idUsuario');
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitudes_id', 'idSolicitud');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'items_id', 'idItem');
    }

    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class, 'tipoMovimientos_id', 'idTipomovimiento');
    }
}

