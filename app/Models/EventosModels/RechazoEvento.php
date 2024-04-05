<?php

namespace App\Models\EventosModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechazoEvento extends Model
{
    use HasFactory;

    protected $table = 'rechazo_evento';

    public $timestamps = false;

    protected $primaryKey = 'rechazo_id';

    protected $fillable = [
        'evento_id',
        'descripcion'
    ];
}
