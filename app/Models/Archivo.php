<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model 
{

    protected $table = 'Archivos';
    public $timestamps = true;
    protected $fillable = array('path');

    public function scopeFilters($query,$datos){
    	if(isset($datos["path"])){
    		$query->where("path",'like',"%".$datos["path"]."%");
    	}
    	
    	
    	return $query;
    		
    }

}