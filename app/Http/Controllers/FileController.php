<?php 

namespace App\Http\Controllers;
use App\Models\File;
use App\Models\Job;
use Illuminate\Http\Request;
use Storage;



class FileController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  protected $file;
  protected $job;
  
  function __construct ( File $file,Job $job){
    $this->file=$file;
    $this->job=$job;
   }

  public function index(Request $request){

   $files = $this->file->list($request->all());
   $data = ["files"=>$files];
   return response()->json(compact('data')); 

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

     if(is_null($request->get("idJob"))){
      throw new Exception("The id job is required", 1);
    }

    $job=$this->job->findOrFail($request->get("idJob"));
  

    if(is_null($job)){
       throw new Exception("The id job  should be valid", 1);
    }

    if(!is_null($request->get("iteration"))) {
      $job->iteration=$request->get("iteration");
    }
    $moves=$this->file->moveToDestiny($job);
     $data=["moves"=>$moves,"message"=>"Your job: ".$job->name." is ready to send!"];
     

    return response()
      ->json(compact('data'));  
    
  }
  public function uploadFiles(Request $request)
  {
     
    for ($i=0; $i <count($request->file('realname')) ; $i++) { 
      $clientFile=$request->file('realname')[$i];
      $file= new file();
      $file->realname=$clientFile->getClientOriginalName();
      $file->fullPath=$clientFile
      ->storeAs('job-0/iteracion-0'
                ,$clientFile->getClientOriginalName(),"jobs");
      $data = ["file"=>$file];
    }
    return response()
      ->json(compact('data'));  
    
  }
  


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
      $file=$this->file->findOrFail($id);
       $data = ["file"=>$file];
       return response()
      ->json(compact('data'));
    }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {

    $file=$this->file->findOrFail($id);
    $job=$this->job::findOrFail($file->idJob);
    //delete before file
    Storage::disk("jobs")->delete('job-'.$job->id."/iteracion-".$job->iteration."/".$file->realname);

    $file->realname=$request->file('realname')->getClientOriginalName();
    $file->fullPath=$request->file('realname')
    ->storeAs('job-'.$job->id."/iteracion-".$job->iteration
              ,$request->file('realname')->getClientOriginalName(),"jobs");
    
    $file->save();
   
    $data = ["file"=>$file];
   return response()->json(compact('data'));

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    //the before file must be deleted
    //$file=$this->file->findOrFail($id);
    //$job=$this->job->findOrFail($file->idJob);
    if(is_null($request->get("idJob"))){
      throw new Exception("The id job is required", 1);
    }
    $directory="job-".$request->get("idJob")."/";

    if(!is_null($request->get("iteration"))){
      $directory.="iteracion-".$request->get("iteration")."/";      
      if((@$request->get("basename"))!="null"){
        $directory.=$request->get("basename");
        Storage::disk("jobs")->delete($directory);
        $message="your file iteration-".$request->get("iteration")."/". $request->get("basename") ." has been deleted!";         
        $data = ["message"=>$message];
         return response()->json(compact('data'));     
      }
      //throw new Exception("The iteration is required", 1);    
      Storage::disk("jobs")->deleteDirectory($directory);
      $message="your folder iteration ".$request->get("iteracion")." has been deleted!";
        $data = ["message"=>$message];
         return response()->json(compact('data'));
      
    }else{
      throw new Exception("The iteration is required!", 1);    
    }
       


    //$file->delete();
    
  }

 /**
   * donwload the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function donwload($id,$iteration,$basename)
  {
    //the before file must be deleted
    // $file=$this->file->findOrFail($id);
    // $job=$this->job->findOrFail($file->idJob);

    $file=Storage::disk('jobs')->getDriver()
     ->getAdapter()
     ->applyPathPrefix("/job-".$id."/iteracion-".$iteration."/".$basename);
     
    return response()->download($file);

  }
   
}
?>