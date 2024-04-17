<?php

namespace App\Models\ProductosModels;

use App\Models\UsuarioModels\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruequeProducto extends Model
{
    use HasFactory;
    protected $table = 'trueque_producto';
    public $timestamps = false;
    protected $primaryKey = 'trueque_producto_id';

    protected $fillable = [
        'estado',
        'usuario_solicitante_id',
        'usuario_propietario_id',
        'producto_solicitado_id',
        'producto_intercambiar_id',
        'cantidad_dar',
        'cantdad_solicitar'
    ] ;

    public function usuarioSolicitante()
    {
        return $this->belongsTo(Usuario::class, 'usuario_solicitante_id');
    }

    public function usuarioPropietario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_propietario_id');
    }

    public function productoSolicitado()
    {
        return $this->belongsTo(Producto::class, 'producto_solicitado_id');
    }

    public function productoAdar()
    {
        return $this->belongsTo(Producto::class, 'producto_intercambiar_id');
    }



}
