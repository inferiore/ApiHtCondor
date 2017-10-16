<?php 

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\UserRequest;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  protected $usuario;  

  function __construct ( User $usuario){
    $this->usuario=$usuario;
   }
  public function index(Request $request){

   $usuarios = $this->usuario->filters($request->all())->get();
   $data = ["usuarios"=>$usuarios];

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
  public function store(UserRequest $request)
  {
    
     
    $usuarios=$this->usuario->fill($request->all());
    $this->usuario->save();
     $data = ["usuario"=>$usuarios];
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
      $usuarios=$this->usuario->findOrFail($id);
       $data = ["usuario"=>$usuarios];
       return response()
      ->json(compact('data'));
    }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(UserRequest $request, $id)
  {
   
    $usuarios=$this->usuario->findOrFail($id);
    $usuarios= $usuarios->fill($request->all());
    $usuarios->password=Hash::make($usuarios->password);
    $usuarios->update();
    $data = ["usuario"=>$usuarios];
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
    $usuarios=$this->usuario->findOrFail($id);
    $usuarios->delete();

  }
  
}

?>