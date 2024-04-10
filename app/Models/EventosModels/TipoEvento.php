<?php

namespace App\Models\EventosModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEvento extends Model
{
    use HasFactory;

    protected $table = 'tipo_evento';

    public $timestamps = false;

    protected $primaryKey = 'tipo_even_id';

    protected $fillable = [
        'alias',
        'descripcion',
        'estado'
    ];

    public function controlTipoEvento()
    {
        return $this->hasMany(ControlTipoEvento::class);
    }
}
