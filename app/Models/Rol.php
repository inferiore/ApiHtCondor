<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model 
{

    protected $table = 'Roles';
    public $timestamps = true;
    protected $fillable = array('nombre', 'estado');

}