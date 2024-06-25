<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudHasTrabajador extends Model
{
    use HasFactory;

    protected $table = 'Solicitudes_has_trabajadores';
    protected $primaryKey = 'idSolicitudtrabajadores';
    public $timestamps = true;

    // Define an empty array for guarded to allow all other attributes to be mass assignable
    protected $guarded = [];

    // Define relationships
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitudes_id');
    }

    public function tipoMantenimiento()
    {
        return $this->belongsTo(TipoMantenimiento::class, 'soli_tipoMantenimientos_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'solicitudes_estados_id');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'trabajadores_id');
    }
}
