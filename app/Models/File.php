<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model 
{

    protected $table = 'files';
    public $timestamps = true;
    protected $fillable = array('realname','fullPath','idJob');

    public function scopeFilters($query,$datos){
    	if(isset($datos["fullPath"])){
    		$query->where("fullPath",'like',"%".$datos["fullPath"]."%");
    	}
        if(isset($datos["idJob"])){
            if(is_array($datos["idJob"]))
                $query->whereIn("idJob",$datos["path"])
            else
                $query->where("idJob",$datos["idJob"]);
        }
        
    	return $query;
    		
    }

}