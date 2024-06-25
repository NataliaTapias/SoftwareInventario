<?php
// app/Models/Subcategoria.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $primaryKey = 'idSubcategoria';
    protected $fillable = ['nombre', 'categorias_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categorias_id', 'idCategoria');
    }
}
