<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model 
{

    protected $table = 'Archivos';
    public $timestamps = true;
    protected $fillable = array('path');

}