<?php 

namespace App\Http\Controllers;
use App\Models\Terea;
class TereaController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  protected $terea;
  function __construct ( Terea $terea){
    $this->terea=$terea;
   }

  public function index(Request $request){

   $tereas = $this->terea->filters($request->all())->get();
   $data = ["tereas"=>$tereas];

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
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
     
    $tereas=$this->terea;
   
    $tereas=$tereas->fill($request->all());
    $this->terea->save();
     $data = ["terea"=>$tereas];
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
      $tereas=$this->terea->findOrFail($id);
       $data = ["Terea"=>$tereas];
       return response()
      ->json(compact('data'));
    }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Terea $request, $id)
  {

   $tereas=$this->terea->findOrFail($id);
   $tereas= $tereas->fill($request->all());
       
        $tereas->update();

           $data = ["terea"=>$tereas];
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
    $tereas=$this->terea->findOrFail($id);
  
  $tereas->delete();

  }
  
}

?>