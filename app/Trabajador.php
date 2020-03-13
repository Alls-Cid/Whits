<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
	protected $fillable = ['nombre','estatus','img_profile','lat','lng','telefono','password','conexion','descripcion','experiencia','meses_pagados','calificacion'];
    /**
 * Get the route key for the model.
 *
 * 
 */

}