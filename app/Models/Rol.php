<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model 
{

    protected $table = 'Roles';
    public $timestamps = true;
    protected $fillable = array('nombre', 'estado');

    public function scopeFilters($query,$datos){
    	if(isset($datos["nombre"])){
    		$query->where("nombre",'like',"%".$datos["nombre"]."%");
    	}
    	if(isset($datos["estado"])){
    		$query->where("estado",'like',"%".$datos["estado"]."%");
    	}
    	
    	return $query;
    		
    }

}