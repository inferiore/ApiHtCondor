<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
class User extends Authenticatable 
{

    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = array('fullName','idRol', 'code', 'password', 'email');

    protected $hidden = array('remember_token');

    public function scopeFilters($query,$datos){
    	if(isset($datos["fullname"])){
    		$query->where("fullname",'like',"%".$datos["fullname"]."%");
    	}
        if(isset($datos["idRol"])){
            if(is_array($datos["idRol"])){
                $query->whereIn("idRol",$datos["idRol"]);
            }else{
                $query->where("idRol",$datos["idRol"]);
            }
        }
    	if(isset($datos["code"])){
    		$query->where("code",'like',"%".$datos["code"]."%");
    	}
    	
    	if(isset($datos["email"])){
    		$query->where("email",'like',"%".$datos["email"]."%");
    	}
    	
    	return $query;
    		
    }
    public function scopeIndex($query,$datos){
        
    }




}