<?php 

namespace App\Http\Controllers;


use App\Models\JobState;
use App\Models\Tool;
use App\Models\Job;
use App\Models\File;
use JWTAuth;
use Illuminate\Http\Request;
use Validaciones\JobRequest;
use Illuminate\Support\Facades\Auth;
use Storage;
use Exception;
use Carbon\Carbon;

class JobController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  protected $jobs;
  protected $states;
  protected $tools;
  protected $file;
  
  
  function __construct (JobState $states,Job $jobs,Tool $tools,File $file){
    
    $this->jobs=$jobs;
    $this->states=$states;
    $this->tools=$tools;
    $this->file=$file;
    
   }

  public function index(Request $request){

   $jobs = $this->jobs->filters($request->all())->index()->get();
   $tools = $this->tools->all();
   $states = $this->states->all();
   
   $data = ["jobs"=>$jobs,"tools"=>$tools,"states"=>$states];

   return response()
      ->json(compact('data')); 

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {


  $tools = $this->tools->all();//->where("idState",2)->get();
   $states = $this->states->all();
   
   $data = ["tools"=>$tools,"states"=>$states];

   return response()
      ->json(compact('data')); 
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(JobRequest $request)
  {
    
    $job=$this->jobs->fill($request->all());

    $job->name=Auth::user()->code."-".$job->name;
    $job->idInsertUser=Auth::user()->id;
    $job->iteration=1;
    $job->algorithm=$request->file('algorithm')->getClientOriginalName();
    $job->save();
    $request->file('algorithm')
    ->storeAs('job-'.$job->id."/iteracion-".$job->iteration
              ,$request->file('algorithm')->getClientOriginalName(),"jobs");
   
     
    $data = ["job"=>$job,"message"=>"Created It!"];
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
      $job=$this->jobs->findOrFail($id);
      $tools = $this->tools->all();//where("idState",2)->get();
      $states = $this->states->all();
       $data = ["job"=>$job,"tools"=>$tools,"states"=>$states];
       
       return response()->json(compact('data'));
    }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id,Request $request)
  {

   $job=$this->jobs->findOrFail($id);
   $job= $job->fill($request->all());
   $job->name=Auth::user()->code."-".$job->name;   
    $job->update();
           $data = ["job"=>$job,"message"=>"Updated It!"];
       return response()
      ->json(compact('data'));
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $job=$this->jobs->findOrFail($id);
    $job->delete();
    $data = ["job"=>$job,"message"=>"Delete It!"];
    return response()
      ->json(compact('data'));
     
  }

  public function showSubmit($id){
    $job=$this->jobs->findOrFail($id);    
    $textFile="executable = ".$job->algorithm
    ."\nuniverse = vanilla"
    ."\nlog = log"
    ."\noutput = ".$job->outPut
    ."\nQueue";

    //create a .submit base
    Storage::disk('jobs')->put('job-'.$job->id."/iteracion-".$job->iteration."/".$job->submitCondor, $textFile);
    $textSubmitCondor=Storage::disk('jobs')->get(
      '/job-'.$job->id."/iteracion-".$job->iteration."/".$job->submitCondor);
    return response()
      ->json(compact('textSubmitCondor'));



  }
  public function sendJob($id,Request $request){
    $job=$this->jobs->findOrFail($id);
    $job->iteration=$job->iteration+1;
    $job->idState=2;
    Storage::disk('jobs')->put('job-'.$job->id."/iteracion-".$job->iteration."/".$job->submitCondor, $request->get("textFile"));
    //before send the job to server  all files in actual iteration folder  must be copied to  new  iteration folder
    //i must be sure that  all files are copied, for reduce probability error in next iteration
    try{
        //1.copy algoritm
      $exists = Storage::disk('jobs')
      ->copy('job-'.$job->id."/iteracion-".($job->iteration-1)."/".$job->algorithm,
      'job-'.$job->id."/iteracion-".$job->iteration."/".$job->algorithm);
      //2. copy parameters
       $files=$this->file->where("idJob",$job->id)->get(); 
      foreach ($files as $value) {
        Storage::disk('jobs')
        ->copy('job-'.$job->id."/iteracion-".($job->iteration-1)."/".$value->realname,
        'job-'.$job->id."/iteracion-".$job->iteration."/".$value->realname);
      }
    } catch (Exception $e){
      throw new Exception("some files not was copied, please contact support", 1);
    }
     $job->save();

   return response()->json(["msj"=>"job send successful"]);
  
  }

  public function cancelJob($id){
    $job=$this->jobs->findOrFail($id);
    $job->idState=1;
    $job->save();
    return response()
      ->json(["msj"=>"job send successful"]);
  
  }
  

  public function changeAlgorithm($id, Request $request){

    $job=$this->jobs->findOrFail($id)->fill($request->all());

    //the before file must be deleted
    Storage::disk("jobs")->delete('job-'.$job->id."/iteracion-".$job->iteration."/".$job->algorithm);
    

    $job->algorithm=$request->file('algorithm')->getClientOriginalName();
    //save the new file on disk
    $request->file('algorithm')
    ->storeAs('job-'.$job->id."/iteracion-".$job->iteration
              ,$request->file('algorithm')->getClientOriginalName(),"jobs");
    $data = ["job"=>$job];
   $job->save();
       return response()->json(compact('data','path'));
  }

  public function downloadAlgorithm($id){
    $job=$this->jobs->findOrFail($id);
     $file=Storage::disk('jobs')->getDriver()
     ->getAdapter()
     ->applyPathPrefix("/job-".$id."/iteracion-".$job->iteration."/".$job->algorithm);
    return response()->download($file);

  }
  
}

?>