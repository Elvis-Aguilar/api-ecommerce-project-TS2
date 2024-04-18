<?php

namespace App\Models\UsuarioModels;

use App\Models\EventosModels\Evento;
use App\Models\EventosModels\ListaAsistencia;
use App\Models\ProductosModels\CompraProducto;
use App\Models\ProductosModels\Producto;
use App\Models\ProductosModels\TruequeProducto;
use App\Models\ProductosModels\TruequeProductoServicio;
use App\Models\ServiciosModels\Oferta;
use App\Models\ServiciosModels\Servicio;
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

    public function servicio()
    {
        return $this->hasMany(Servicio::class);
    }

    public function evento()
    {
        return $this->hasMany(Evento::class);
    }

    public function cuentaMonetaria()
    {
        return $this->belongsTo(CuentaMonetaria::class);
    }

    public function compraProducto()
    {
        return $this->hasMany(CompraProducto::class);
    }

    public function listaAsistencia()
    {
        return $this->hasMany(ListaAsistencia::class);
    }

    public function truequeProducto()
    {
        return $this->hasMany(TruequeProducto::class);
    }

    public function oferta()
    {
        return $this->hasMany(Oferta::class);
    }

    public function truequeProductoServicio()
    {
        return $this->hasMany(TruequeProductoServicio::class);
    }


}
