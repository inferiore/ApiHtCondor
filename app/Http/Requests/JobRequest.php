<?php

namespace Validaciones;

class JobRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

         switch ($this->method()) {
            case 'PUT':
                return 
                [
                    'name' => 'required',
                    'idState' => 'required'
                ];  
            case 'POST':

               return
                [
                    'name' => 'required',
                    'algorithm' => 'required'
                ];  
        }        
     }
}
