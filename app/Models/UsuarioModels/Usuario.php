<?php

namespace App\Models\UsuarioModels;

use App\Models\ProductosModels\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'usuario';

    protected $primaryKey = 'usuario_id';
    protected $fillable = [
        'nombre_completo',
        'contrasenia',
        'nombre_usuario',
        'url_foto',
        'info_contacto',
        'rol'
    ];

    protected $hidden = [
        'contrasenia'
    ] ;

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol');
    }

    public function infoContacto()
    {
        return $this->hasOne(UsuarioInfoContacto::class, 'usuario_info_id');
    }

    public function producto()
    {
        return $this->hasMany(Producto::class);
    }
}
