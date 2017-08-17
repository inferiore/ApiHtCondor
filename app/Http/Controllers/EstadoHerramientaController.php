<?php 

namespace App\Http\Controllers;
use App\Models\EstadoHerramienta;
use Illuminate\Http\Request;
use  Validaciones\EstadoHerramientaRequest;
class EstadoHerramientaController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  protected $estadoHerramienta;

   
   function __construct ( EstadoHerramienta $estadoHerramienta){
    $this->estadoHerramienta=$estadoHerramienta;
   }

  public function index(Request $request){

   $estados = $this->estadoHerramienta->filters($request->all())->get();
   $data = ["estados"=>$estados];

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
  public function store(EstadoHerramientaRequest $request)
  {
    
     
    $estado=$this->estadoHerramienta;
   
    $estado=$estado->fill($request->all());
    $this->estadoHerramienta->save();
     $data = ["estado"=>$estado];
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
      $estado=$this->estadoHerramienta->findOrFail($id);
       $data = ["estado"=>$estado];
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
   $estado=$this->estadoHerramienta->findOrFail($id);
   $estado= $estado->fill($request->all());
       
        $estado->update();

           $data = ["estado"=>$estado];
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
    $estado=$this->estadoHerramienta->findOrFail($id);
  
  $estado->delete();

  }
  
}

?>