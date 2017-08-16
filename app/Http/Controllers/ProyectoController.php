<?php 

namespace App\Http\Controllers;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  protected $proyecto;

  function __construct ( Proyecto $proyecto){
    $this->proyecto=$proyecto;
   }

  public function index(Request $request){

   $proyectos = $this->proyecto->filters($request->all())->get();
   $data = ["proyectos"=>$proyectos];

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
    
     
    $proyectos=$this->proyecto;
   
    $proyectos=$proyectos->fill($request->all());
    $this->proyecto->save();
     $data = ["proyecto"=>$proyectos];
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
      $proyectos=$this->proyecto->find($id);
       $data = ["proyecto"=>$proyectos];
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
   $proyectos=$this->proyecto->find($id);
   $proyectos= $proyectos->fill($request->all());
       
        $proyectos->update();

           $data = ["proyecto"=>$proyectos];
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
    $proyectos=$this->proyecto->findOrFail($id);
  
    $proyectos->delete();

  }
  
}

?>