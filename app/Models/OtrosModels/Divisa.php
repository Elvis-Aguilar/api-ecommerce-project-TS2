<?php

namespace App\Models\OtrosModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisa extends Model
{
    use HasFactory;

    protected $table = 'divisa';

    public $timestamps = false;

    protected $primaryKey = 'divisa_id';

    protected $fillable = [
        'moneda_local',
        'moneda_sistema',
        'fecha_actualizacion'
    ];
}
