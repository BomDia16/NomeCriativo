<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraIngressoRequest extends FormRequest
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
            'ingresso_qtd' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'ingresso_qtd.required' => 'O campo quantidade de ingressos é obrigatório!'
        ];
    }
}
