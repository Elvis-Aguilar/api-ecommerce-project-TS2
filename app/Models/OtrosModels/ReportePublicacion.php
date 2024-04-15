<?php

namespace App\Models\OtrosModels;

use App\Models\EventosModels\Evento;
use App\Models\ProductosModels\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportePublicacion extends Model
{
    use HasFactory;

    protected $table = 'reporte_publicacion';

    public $timestamps = false;

    protected $primaryKey = 'reporte_publicacion_id';

    protected $fillable = [
        'reporte_publicacion_id',
        'estado',
        'evento_id',
        'producto_id',
        'descripcion'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }
}
