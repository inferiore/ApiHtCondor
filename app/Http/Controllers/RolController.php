<?php 

namespace App\Http\Controllers;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  protected $rol;  

  function __construct ( Rol $rol){
    $this->rol=$rol;
   }
  public function index(Request $request){

   $roles = $this->rol->filters($request->all())->get();
   $data = ["roles"=>$roles];

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
    
     
    $roles=$this->rol;
   
    $roles=$roles->fill($request->all());
    $this->rol->save();
     $data = ["rol"=>$roles];
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
      $roles=$this->rol->find($id);
       $data = ["rol"=>$roles];
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
   // dd($request->all());
   $roles=$this->rol->find($id);
   $roles= $roles->fill($request->all());
       
        $roles->update();

           $data = ["rol"=>$roles];
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
    $roles=$this->rol->findOrFail($id);
  
  $roles->delete();

  }
  
}

?>