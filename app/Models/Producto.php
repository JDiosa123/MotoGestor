<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto'; 
        protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = ['nombre','categoria','cantidad','precio','descripcion','fecha_registro','Usuario_id_usuario'];
}
