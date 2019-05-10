<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidationFormRequest extends FormRequest
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
        $rules = [
            'name'=>'required|string',
            'email'=>"required|email|unique:users,email,$this->id,id",
            'tipo_doc'=>'required|in:"C","R","T"',
            'documento'=>'required',
            'grupo_usuarios_id'=>'required|exists:grupo_usuarios,id',
        ];
        if ($this->tipo_doc =='C')
            $rules['documento']= 'required|cpf';

        if (array_key_exists('password', $this->request->all())){
            $rules['password'] = 'required|min:6|max:8';
            $rules['confirma'] = 'same:password';
        }

        return $rules;
    }
}
