<?php
namespace App;

//use Carbon\Carbon;
//use Jenssegers\Date\Date;
//use Modelos\Configuracion\Objeto;

use Illuminate\Database\Eloquent\Model;

class Intermediate extends Model
{
    protected $perPage = 20;
    protected $connection = 'mysql';
    //protected $dateFormat = 'Y-m-d H:i:s.u';
    /*public function fromDateTime($value)
    {
        return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s');
    }

    public function getObjeto()
    {
    	return Objeto::where('nombre', 'like', '%'.get_class($this).'%')->first();
    }*/
    public function getId()
    {
    	return $this->getKey();
    }
   
}