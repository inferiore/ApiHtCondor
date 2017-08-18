<?php 

namespace App\Http\Controllers;
use App\Models\Archivo;
use Illuminate\Http\Request;

class ArchivoController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  protected $archivo;
  function __construct ( Archivo $archivo){
    $this->archivo=$archivo;
   }

  public function index(Request $request){

   $archivos = $this->archivo->filters($request->all())->get();
   $data = ["archivos"=>$archivos];

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
    
     
    $archivos=$this->archivo;
   
    $archivos=$archivos->fill($request->all());
    $this->archivo->save();
     $data = ["archivo"=>$archivos];
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
      $archivos=$this->archivo->findOrFail($id);
       $data = ["archivo"=>$archivos];
       return response()
      ->json(compact('data'));
    }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Archivo $request, $id)
  {

   $archivos=$this->archivo->findOrFail($id);
   $archivos= $archivos->fill($request->all());
       
        $archivos->update();

           $data = ["archivos"=>$archivos];
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
    $archivos=$this->archivo->findOrFail($id);
  
  $archivos->delete();

  }
  
}

?>