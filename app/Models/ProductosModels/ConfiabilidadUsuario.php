<?php

namespace App\Models\ProductosModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiabilidadUsuario extends Model
{
    use HasFactory;

    protected $table = 'confiabilidad_usuario';
    public $timestamps = false;

    protected $primaryKey = 'confiabilidad_usuario_id';
    protected $fillable = [
        'usuario_id',
        'usuario_aprobados',
        'min_aprobados'
    ];
}
