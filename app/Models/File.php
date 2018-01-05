<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class File extends Model 
{

    protected $table = 'files';
    public $timestamps = true;
    protected $fillable = array('realname','idJob');

    public function list($datos){
    	
        $ruta='jobs/job-';        
        if(isset($datos["idJob"])){
            $ruta.=$datos["idJob"]."/";
            if(isset($datos["iteration"])){
                $ruta.="iteracion-".$datos["iteration"]."/";
            }else{
                return Storage::disk('jobs')->directories('job-'.$datos["idJob"]);
            }
        }
    	return Storage::files($ruta);    		
    }

    public function moveToDestiny($job){
        $files = Storage::files('jobs/job-0/iteracion-0');
        $moves=[];
        foreach ($files as $file) {            
           $moves[]=Storage::move($file, "jobs/job-".$job->id."/iteracion-".$job->iteration."/".basename($file));
        }
        return $moves;        
    }
}