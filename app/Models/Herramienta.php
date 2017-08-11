<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model 
{

    protected $table = 'Herramientas';
    public $timestamps = true;
    protected $fillable = array('nombre', 'descripcion');

}