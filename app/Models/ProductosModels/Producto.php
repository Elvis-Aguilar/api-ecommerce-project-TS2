<?php

namespace App\Models\ProductosModels;

use App\Models\OtrosModels\ReportePublicacion;
use App\Models\UsuarioModels\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    public $timestamps = false;

    protected $primaryKey = 'producto_id';

    protected $fillable = [
        'nombre',
        'estado',
        'usuario_vendedor',
        'fecha_reg_actuli',
        'descripcion',
        'especificaciones',
        'cantidad_exit',
        'url_foto',
        'permite_trueque',
        'permite_contactar',
        'moneda_local',
        'moneda_sistema'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_vendedor');
    }

    public function categoriaProducto()
    {
        return $this->hasMany(CategoriaProducto::class);
    }

    public function reportePublicacion()
    {
        return $this->hasMany(ReportePublicacion::class);
    }


}
