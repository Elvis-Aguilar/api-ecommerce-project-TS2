<?php

namespace App\Models\UsuarioModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioInfoContacto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'usuario_info_contacto';
    protected $fillable = [
        'url_facebook',
        'url_instagram',
        'url_linkedin',
        'url_telegram',
        'number_whatsapp',
        'correo'
    ];


    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

}
