<?php

namespace App\Models\EventosModels;

use App\Models\UsuarioModels\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaAsistencia extends Model
{
    use HasFactory;
    protected $table = 'lista_asistencia';
    public $timestamps = false;
    protected $primaryKey = 'lista_asistencia_id';

    protected $fillable = [
        'usuario_id',
        'evento_id',
        'estado'
    ] ;

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

}
