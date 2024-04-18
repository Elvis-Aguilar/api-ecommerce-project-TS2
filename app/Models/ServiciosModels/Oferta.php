<?php

namespace App\Models\ServiciosModels;

use App\Models\UsuarioModels\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;
    protected $table = 'oferta';
    public $timestamps = false;
    protected $primaryKey = 'oferta_id';

    protected $fillable = [
        'estado',
        'usuario_ofertante_id',
        'usuario_propietario_id',
        'servicio_id',
        'moneda_ms',
        'moneda_local',
        'descripcion'
    ];

    public function usuarioOfertante()
    {
        return $this->belongsTo(Usuario::class, 'usuario_ofertante_id');
    }

    public function usuarioPropietario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_propietario_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
}
