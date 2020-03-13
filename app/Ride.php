<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = ['calificacion_trab','calificacion_usuario','comentario','tiempo','estatus'];
}
