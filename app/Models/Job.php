<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Storage;
use GuzzleHttp\Client;

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
        ->select("jobs.*","jobstates.name as nameState","jobstates.class","tools.name as nameTool")
        ->orderBy("jobs.id");
        return $query;   
    }

     public function scopeLast($query)
    {
        $query->where("idInsertUser",Auth::user()->id)->orderBy("id","desc")->take(1);
        return $query->get();   
    }

    public function copyFolder($fromIteration,$toIteration){
        Storage::makeDirectory('jobs/job-'.$this->id.'/iteracion-'.$fromIteration);
        $files = Storage::files('jobs/job-'.$this->id.'/iteracion-'.$fromIteration);
        $copy=[];
        foreach ($files as $file) {
           $copy[]=Storage::copy($file, "jobs/job-".$this->id."/iteracion-".$toIteration."/".basename($file));
        }
        return $copy;        
    }

    public function sendFileToExternalServer($iteration){

        $listFile = Storage::files('jobs/job-'.$this->id.'/iteracion-'.$iteration);
        $files=[];
        foreach ($listFile as $file) {
             $fopen=Storage::disk('jobs')->getDriver()
                ->getAdapter()
             ->applyPathPrefix("/job-".$this->id."/iteracion-".$iteration."/".basename($file));
            $files[]=["name"=>"file[]","contents"=>fopen($fopen, "r")];           
        }        
        try{
        $client = new Client();
        $apiRequest = $client->request('POST', 'http://45.55.68.97:5000/upload/'.$this->id.'/'.$iteration, 
          [
          'multipart' => $files                        
          ]);
        $response = json_decode($apiRequest->getBody());        

        return $response;        
        } catch(Exception $e){
            throw new Exception("Error while sending  files to external server please check config", 1);
            
        }
    }

    public function send($iteration){
         
        try{
        $client = new Client();
        $apiRequest = $client->request('get', 'http://45.55.68.97:5000/condor/8.0.5/ejecucion/'.$this->id.'/'.$iteration.'/'.$this->submitCondor,[]);
         $response = json_decode($apiRequest->getBody());        
        return $response;        
        } catch(Exception $e){
            throw new Exception("Error while sending  files to external server please check config", 1);
            
        }
    }
    public function downloadResults($iteration){
        $client = new Client();
        $downloads=$this->filesInServer($iteration);
        foreach ($downloads as  $download) {
             echo basename($download)."<br>";
            $pathToSave=str_replace("/","\\",str_replace(basename($download), "", $download));
            $pathToSave=str_replace(basename($download), "", $download);            
            $resource = fopen($download, 'w');
            $client->request('POST', 'http://45.55.68.97:5000/download/'.$this->id.'/'.$iteration."/".basename($download)
             , ['sink' =>$resource]);
        }
        
    }
    public function filesInServer($iteration){
        $client = new Client();
        $apiRequest = $client->request('get', 'http://45.55.68.97:5000/showFile/'.$this->id.'/'.$iteration, []);
        $response = json_decode($apiRequest->getBody());
        $filesInServer=$response->files;

        $files = Storage::files('jobs/job-'.$this->id.'/iteracion-'.$iteration);
        $names=[];
        foreach ($files as  $value) {
            $names[]=basename($value);
        }
        $downloads=array_diff($filesInServer,$names);
        $fopenTodownloads=[];

        foreach ($downloads as  $value) {
            $staticPath=Storage::disk('jobs')->getDriver()
                ->getAdapter()
             ->applyPathPrefix("/job-".$this->id."/iteracion-".$iteration."/".basename($value));
            $fopenTodownloads[]=$staticPath;            
            }         
            return $fopenTodownloads;           
        }


}