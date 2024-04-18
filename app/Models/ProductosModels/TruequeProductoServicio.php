<?php

namespace App\Models\ProductosModels;

use App\Models\ServiciosModels\Servicio;
use App\Models\UsuarioModels\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruequeProductoServicio extends Model
{
    use HasFactory;

    protected $table = 'trueque_producto_servicio';
    public $timestamps = false;
    protected $primaryKey = 'trueque_producto_servicio_id';


    protected $fillable = [
        'estado',
        'usuario_oferta_id',
        'usuario_servicio_id',
        'servicio_intercambiar_id',
        'producto_intercambiar_id',
        'cantidad_producto'
    ] ;

    public function usuarioOferta()
    {
        return $this->belongsTo(Usuario::class, 'usuario_oferta_id');
    }

    public function usuarioServicio()
    {
        return $this->belongsTo(Usuario::class, 'usuario_servicio_id');
    }

    public function productoIntercambiar()
    {
        return $this->belongsTo(Producto::class, 'producto_intercambiar_id');
    }

    public function servicioIntercambiar()
    {
        return $this->belongsTo(Servicio::class, 'servicio_intercambiar_id');
    }
}
