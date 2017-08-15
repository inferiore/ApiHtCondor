<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Herramienta extends Model 
{

    protected $table = 'Herramientas';
    public $timestamps = true;
    protected $fillable = array('nombre', 'descripcion');

    public function scopeFilters($query,$datos){
    	if(isset($datos["nombre"])){
    		$query->where("nombre",'like',"%".$datos["nombre"]."%");
    	}
    	if(isset($datos["descripcion"])){
    		$query->where("descripcion",'like',"%".$datos["descripcion"]."%");
    	}
    	
    	return $query;
    		
    }
}