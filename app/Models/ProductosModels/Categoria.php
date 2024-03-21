<?php

namespace App\Models\ProductosModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';
    public $timestamps = false;

    protected $fillable = [
        'alias',
        'descripcion'
    ];
}
