<?php

namespace Validaciones;

class ToolRequest extends ApiRequest
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
                'name' => 'required',
                'observation' => 'required',
                'idState' => 'required',
                'path' => 'required'
                      
        ];
    }
}
