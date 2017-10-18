<?php 

namespace App\Http\Controllers;


use App\Models\JobState;
use App\Models\Tool;
use App\Models\Job;
use JWTAuth;
use Illuminate\Http\Request;
use Validaciones\JobRequest;
use Illuminate\Support\Facades\Auth;

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
  
  function __construct (JobState $states,Job $jobs,Tool $tools){
    
    $this->jobs=$jobs;
    $this->states=$states;
    $this->tools=$tools;
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
    $job->iteration=0;
    
    $job->save();
    $data = ["job"=>$job];
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
  public function update($id,JobRequest $request)
  {

   $job=$this->jobs->findOrFail($id);
   $job= $job->fill($request->all());
    $job->name=Auth::user()->code."-".$job->name;       
        $job->update();

           $data = ["job"=>$job];
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
  }
  
}

?>