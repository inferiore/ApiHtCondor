<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model 
{

    protected $table = 'jobs';
    public $timestamps = true;
    protected $fillable = array('name', 'observation', 'algorithm', 'outPut','submitCondor','idState','idTool');
  
    public function scopeFilters($query,$datos){

    	if(isset($datos["name"])){
    		$query->where("name",'like',"%".$datos["name"]."%");
    	}

    	if(isset($datos["observation"])){
    		$query->where("observation",'like',"%".$datos["observation"]."%");
    	}
    	if(isset($datos["algorithm"])){
    		$query->where("algorithm",'like',"%".$datos["algorithm"]."%");
    	}
    	
    	if(isset($datos["idState"])){
            if(is_array($datos["idState"]))
                $query->whereIn("idState",$datos["idState"]);
            else
                $query->where("idState",$datos["idState"]);
                
        	}
    	
    	return $query;
    		
    }

     public function scopeIndex($query)
    {
        $query->join("jobstates","jobstates.id","=","jobs.idState")
        ->join("tools","tools.id","=","jobs.idTool")
        ->select("jobs.*","jobstates.name as nameState","jobstates.class","tools.name as nameTool");
        return $query;   
    }

}