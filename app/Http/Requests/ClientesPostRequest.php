<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'empresa' => 'required|numeric|exists:empresas,codigo',
            'codigo' => 'required|numeric|unique:clientes,codigo,NULL,id,empresa,' . $this->empresa,
            'razao_social' => 'required|string|max:255',
            'tipo' => 'required|in:PJ,PF',
            'cpf_cnpj' => 'required|string|size:14'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome do cliente é obrigatório.',
            'empresa.required' => 'A empresa do cliente é obrigatória.',
            'empresa.exists' => 'A empresa informada não existe.',
        ];
    }

    protected function prepareForValidation()
    {
       
        if (!$this->isJson()) {
            abort(response()->json(['error' => 'A requisição deve ser JSON'], 415));
        }

        if (empty($this->all())) {
            abort(response()->json(['error' => 'O corpo da requisição JSON não pode estar vazio'], 400));
        }
    }
}
