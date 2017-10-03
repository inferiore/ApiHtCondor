<?php

namespace App\Models;
use App\Intermediate;

class JobState extends Intermediate 
{

    protected $table = 'jobStates';    
    public $timestamps = false;
    protected $fillable = array('name', 'class');



    public function scopeFilters($query,$datos){
    	if(isset($datos["name"])){
    		$query->where("name",'like',"%".$datos["name"]."%");
    	}
    	if(isset($datos["class"])){
    		$query->where("class",'like',"%".$datos["class"]."%");
    	}
    	
    	return $query;
    		
    }
}