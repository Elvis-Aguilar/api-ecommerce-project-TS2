<?php

namespace App\Models\ProductosModels;

use App\Models\UsuarioModels\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraProducto extends Model
{
    use HasFactory;

    protected $table = 'compra_producto';

    public $timestamps = false;

    protected $primaryKey = 'compra_producto_id';

    protected $fillable = [
        'usuario_comprador_id',
        'usuario_vendedor_id',
        'producto_id',
        'cantidad_comprado',
        'total_moneda_ms',
        'total_moneda_local',
        'fecha_compra'
    ];

    public function usuarioVenedor()
    {
        return $this->belongsTo(Usuario::class, 'usuario_vendedor_id');
    }

    public function usuarioComprador()
    {
        return $this->belongsTo(Usuario::class, 'usuario_comprador_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }



}
