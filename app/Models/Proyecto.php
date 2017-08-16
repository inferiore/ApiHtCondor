<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model 
{

    protected $table = 'Proyectos';
    public $timestamps = true;
    protected $fillable = array('nombre');

    public function scopeFilters($query,$datos){
    	if(isset($datos["nombre"])){
    		$query->where("nombre",'like',"%".$datos["nombre"]."%");
    	}
    	
    	return $query;
    		
    }

}