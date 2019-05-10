<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitanteValidationFormRequest extends FormRequest
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
        $rules = 
        [
            'nome' => 'required',
            'tipo_doc' => 'required|in:"C","R","T"',
            'documento' => 'required',
            'imagem' => 'mimes:jpg,jpeg,png',
        ];
        if ($this->tipo_doc =='C')
            $rules['documento']= 'required|cpf';

        return $rules;
    }
}
