<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoHerramienta extends Model 
{

    protected $table = 'estadosHerramienta';
    public $timestamps = true;
    protected $fillable = array('nombre', 'clase');



    public function scopeFilters($query,$datos){
    	if(isset($datos["nombre"])){
    		$query->where("nombre",'like',"%".$datos["nombre"]."%");
    	}
    	if(isset($datos["clase"])){
    		$query->where("clase",'like',"%".$datos["clase"]."%");
    	}
    	
    	return $query;
    		
    }
}