<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name'      => ['required', 'max:255'],
            'usuario'   => ['required'],
            'email'     => ['required', 'max:255', 'email',],
            'cep'       => ['required', 'max:15',],
            'celular'   => ['required', 'max:15'],
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'O campo usuário é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'cep.required' => 'O campo cep é obrigatório!',
            'celular.required' => 'O campo celular é obrigatório!',
            'name.required' => 'O campo nome é obrigatório!',
        ];
    }
}
