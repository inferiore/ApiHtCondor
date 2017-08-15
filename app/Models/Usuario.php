<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model 
{

    protected $table = 'Usuarios';
    public $timestamps = true;
    protected $fillable = array('nombre', 'sApellido', 'codigo', 'password', 'email');
    protected $hidden = array('remember_token','password');

}