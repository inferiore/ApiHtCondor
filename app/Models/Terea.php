<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terea extends Model 
{

    protected $table = 'Tareas';
    public $timestamps = true;
    protected $fillable = array('idProyecto', 'nombre', 'descripcion', 'path', 'pathResultLog');

    public function scopeFilters($query,$datos){
    	if(isset($datos["idProyecto"])){
    		$query->where("idProyecto",'like',"%".$datos["idProyecto"]."%");
    	}
    	if(isset($datos["nombre"])){
    		$query->where("nombre",'like',"%".$datos["nombre"]."%");
    	}

    	if(isset($datos["descripcion"])){
    		$query->where("descripcion",'like',"%".$datos["descripcion"]."%");
    	}
    	if(isset($datos["path"])){
    		$query->where("path",'like',"%".$datos["path"]."%");
    	}
    	
    	if(isset($datos["pathResultLog"])){
    		$query->where("pathResultLog",'like',"%".$datos["pathResultLog"]."%");
    	}
    	
    	return $query;
    		
    }

}