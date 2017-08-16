<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model 
{

    protected $table = 'Usuarios';
    public $timestamps = true;
    protected $fillable = array('nombre', 'sApellido', 'codigo', 'password', 'email');
    protected $hidden = array('remember_token','password');

    public function scopeFilters($query,$datos){
    	if(isset($datos["nombre"])){
    		$query->where("nombre",'like',"%".$datos["nombre"]."%");
    	}
    	if(isset($datos["sApellido"])){
    		$query->where("sApellido",'like',"%".$datos["sApellido"]."%");
    	}

    	if(isset($datos["codigo"])){
    		$query->where("codigo",'like',"%".$datos["codigo"]."%");
    	}
    	if(isset($datos["password"])){
    		$query->where("password",'like',"%".$datos["password"]."%");
    	}
    	
    	if(isset($datos["email"])){
    		$query->where("email",'like',"%".$datos["email"]."%");
    	}
    	
    	return $query;
    		
    }

}