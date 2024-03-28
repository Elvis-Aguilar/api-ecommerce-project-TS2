<?php

namespace App\Models\ProductosModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechazoProducto extends Model
{
    use HasFactory;

    protected $table = 'rechazo_producto';
    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'descripcion'
    ];
}
