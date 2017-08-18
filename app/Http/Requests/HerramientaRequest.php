<?php

namespace Validaciones;

class HerramientaRequest extends ApiRequest
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

        return [
                'nombre' => 'required',
                'descripcion' => 'required'
        ];
    }
     public function messages()
 {
     return [
         'nombre.required' => 'El campo nombre es requerido!',
         'descripcion.required' => 'El campo descripcion es requerido!',
  
     ];
 }
}
