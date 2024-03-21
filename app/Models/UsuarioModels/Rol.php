<?php

namespace App\Models\UsuarioModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rol';
    public $timestamps = false;

    protected $fillable = [
        'rol_alias',
        'nivel_autorizacion'
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
