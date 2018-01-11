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
                $folders=Storage::disk('jobs')->directories('job-'.$datos["idJob"]);
                $foldersAux=[];
                for ($i=0; $i <count($folders) ; $i++) { 
                    $folder=new \stdClass();
                    $folder->path=$folders[$i];
                    $folder->start=explode("/", $folder->path)[0];
                    $folder->end=explode("/", $folder->path)[1];
                    $folder->iteration=explode("-", $folder->end)[1];
                    $foldersAux[]=$folder;                       
                }            
                return $foldersAux;
            }
        }
                $files=Storage::files($ruta);
                $filesAux=[];
                for ($i=0; $i <count($files) ; $i++) { 
                    $file=new \stdClass();
                    $file->path=$files[$i];
                    $file->basename= basename($file->path);
                    $filesAux[]=$file;                       
                }            
                return $filesAux;
    	return 0;    		
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