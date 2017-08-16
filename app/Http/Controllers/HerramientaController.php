<?php 

namespace App\Http\Controllers;

use App\Models\Herramienta;
use Illuminate\Http\Request;
use  App\Http\Requests\HerramientaRequest;

class HerramientaController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  protected $herramienta;

  function __construct ( Herramienta $herramienta){
    $this->herramienta=$herramienta;
   }
  public function index(Request $request)
  {
    $herramientas = $this->herramienta->filters($request->all())->get();
   $data = ["herramientas"=>$herramientas];

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
    
    $herramientas=$this->herramienta;
   
    $herramientas=$herramientas->fill($request->all());
    $this->herramienta->save();
     $data = ["herramienta"=>$herramientas];
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
    $herramientas=$this->herramienta->find($id);
       $data = ["herramienta"=>$herramientas];
       return response()
      ->json(compact('data'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $herramientas=$this->herramienta->find($id);
    $herramientas= $herramientas->fill($request->all());
       
        $herramientas->update();

           $data = ["herramienta"=>$herramientas];
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
    $herramientas=$this->herramienta->findOrFail($id);
  
  $herramientas->delete();
  }
  
}

?>