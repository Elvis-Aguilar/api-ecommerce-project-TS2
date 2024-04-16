<?php

namespace App\Models\EventosModels;

use App\Models\OtrosModels\ReportePublicacion;
use App\Models\UsuarioModels\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'evento';

    public $timestamps = false;

    protected $primaryKey = 'evento_id';

    protected $fillable = [
        'estado',
        'nombre',
        'usuario_publicador',
        'descripcion',
        'permite_contactar',
        'es_voluntariado',
        'remunerar_moneda_local',
        'remunerar_moneda_sitema',
        'max_participantes',
        'lugar_realizacion',
        'url_foto',
        'fecha_creacion',
        'fecha_realizacion'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_publicador');
    }

    public function controlTipoEvento()
    {
        return $this->hasMany(ControlTipoEvento::class);
    }

    public function reportePublicacion()
    {
        return $this->hasMany(ReportePublicacion::class);
    }

    public function listaAsistencia()
    {
        return $this->hasMany(ListaAsistencia::class);
    }

}
