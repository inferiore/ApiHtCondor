<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tool extends Model 
{

    protected $table = 'tools';
    public $timestamps = true;
    protected $fillable = array('name','observation','algorithm','idState','idInsertUser','path');

    public function scopeFilters($query,$datos){
    	if(isset($datos["name"])){
            $query->where("tools.name",'like',"%".$datos["name"]."%");
    	}
    	if(isset($datos["observation"])){
    		$query->where("tools.observation",'like',"%".$datos["observation"]."%");
    	}
        if(isset($datos["idState"])){
            if(is_array($datos["idState"]))
                $query->whereIn("tools.idState",$datos["idState"]);
            else
                $query->where("tools.idState",$datos["idState"]);
        }
    	return $query;
    }


    public function scopeIndex($query){
        $query->join("toolstates","toolstates.id","=","idstate")
        ->select('tools.name','observation',"toolstates.name as namState","toolstates.class","toolstates.class");
        return $query;
            
    }
    
}