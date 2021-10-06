<?php

namespace App\Http\Requests;

use App\Rules\ValidarDataNascimento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClienteCreateRequest extends FormRequest
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
            'nome' => 'required|max:255',
            'telefone' => [
                'required',
                Rule::unique('clientes'),
            ],
            'data_nascimento' => [
                'required',
                new ValidarDataNascimento
            ],
        ];
    }

    public function messages(){
        return [
            'nome.required' => 'Informe o Nome do Cliente',
            'nome.max' => 'O Nome Deve Possui no Máximo 255 Caracteres',
            'data_nascimento.valid' => 'Data Inválida'
        ];
    }
}
