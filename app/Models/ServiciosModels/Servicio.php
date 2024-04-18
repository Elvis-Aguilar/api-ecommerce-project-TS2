<?php

namespace App\Models\ServiciosModels;

use App\Models\UsuarioModels\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicio';
    public $timestamps = false;
    protected $primaryKey = 'servicio_id';


    protected $fillable = [
        'estado',
        'nombre',
        'usuario_publicador',
        'descripcion',
        'permite_contactar',
        'lugar_realizacion',
        'url_foto'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_publicador');
    }

    public function oferta()
    {
        return $this->hasMany(Oferta::class);
    }
}
