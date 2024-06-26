<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'Solicitudes';
    protected $primaryKey = 'idSolicitud';
    
    protected $fillable = [
        'fecha',
        'descripcionFalla',
        'tiempoEstimado',
        'tipoMantenimientos_id',
        'fechaInicio',
        'fechaTermina',
        'mantenimientoEficiente',
        'totalHorasTrabajadas',
        'tiempoParada',
        'repuestosUtilizados',
        'observaciones',
        'firmaDirector',
        'firmaGerente',
        'firmaLider',
        'estados_id',
        'areas_id',
    ];

    public function tipoMantenimiento()
    {
        return $this->belongsTo(TipoMantenimiento::class, 'tipoMantenimientos_id', 'idTipomantenimiento');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados_id', 'idEstado');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'areas_id', 'idArea');
    }

    public function solicitudHasTrabajador()
    {
        return $this->hasOne(SolicitudHasTrabajador::class, 'solicitudes_id');
    }
}
