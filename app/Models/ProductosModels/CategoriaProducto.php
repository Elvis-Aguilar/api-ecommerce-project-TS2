<?php

namespace App\Models\ProductosModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    use HasFactory;

    protected $table = 'categoria_producto';
    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'categoria_id'
    ] ;
}
