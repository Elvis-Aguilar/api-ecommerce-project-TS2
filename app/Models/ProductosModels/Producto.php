<?php

namespace App\Models\ProductosModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'usuario_vendedor',
        'fecha_reg_actuli',
        'descripcion',
        'especificaciones',
        'cantidad_exit',
        'url_foto',
        'permite_trueque',
        'permite_contactar',
        'moneda_local',
        'moneda_sistema'
    ];
}
