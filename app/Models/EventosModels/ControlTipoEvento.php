<?php

namespace App\Models\EventosModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlTipoEvento extends Model
{
    use HasFactory;
    protected $table = 'control_tipo_evento';

    public $timestamps = false;

    protected $primaryKey = 'control_tipo_ev_id';


    protected $fillable = [
        'evento_id',
        'tipo_evento_id',
    ];
}
