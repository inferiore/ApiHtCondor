<?php
namespace Validaciones;
use Illuminate\Foundation\Http\FormRequest;
class ApiRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    public function response(array $errors)
    {    
        $respuesta = [   
                        'status'  => 'Bad Request',
                        'errors'  => $errors
                    ];
         return response($respuesta, 400);
    }
}