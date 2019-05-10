<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitaValidationFormRequest extends FormRequest
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
            'visitante_id' => 'required|exists:visitantes,id',
            'setor_id' => 'required|exists:setors,id',
            'cracha' => 'required',
            'assunto' => 'string|nullable',
            'pessoa' => 'string|nullable',
        ];
    }
}
