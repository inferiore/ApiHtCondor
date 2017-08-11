<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terea extends Model 
{

    protected $table = 'Tareas';
    public $timestamps = true;
    protected $fillable = array('idProyecto', 'nombre', 'descripcion', 'path', 'pathResultLog');

}