<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        /**todo : ajustar regras para validar corretametne */
         return [
             'codigo' => 'required|numeric|unique:empresas,codigo',
             'empresa' => 'required|numeric',
             'sigla' => 'required|string|max:40',
             'razao_social' => 'required|string|max:255'
        ];
        
    }

}
