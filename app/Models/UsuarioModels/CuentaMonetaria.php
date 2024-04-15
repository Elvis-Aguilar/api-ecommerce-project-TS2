<?php

namespace App\Models\UsuarioModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaMonetaria extends Model
{
    use HasFactory;
    protected $table = 'cuenta_monetaria';
    public $timestamps = false;
    protected $primaryKey = 'cuenta_monteraia_id';


    protected $fillable = [
        'usuario_id',
        'moneda_ms',
        'moneda_local'
    ];

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'usuario_id');
    }



}

