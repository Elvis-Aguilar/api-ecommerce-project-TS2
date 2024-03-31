<?php

namespace App\Models\ProductosModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';
    public $timestamps = false;

    protected $primaryKey = 'categoria_id';

    protected $fillable = [
        'alias',
        'descripcion',
        'estado'
    ];

    public function categoriaProducto()
    {
        return $this->hasMany(CategoriaProducto::class);
    }
}
