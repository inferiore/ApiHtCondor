<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoHerramienta extends Model 
{

    protected $table = 'estadosHerramienta';
    public $timestamps = true;
    protected $fillable = array('nombre', 'clase');

}