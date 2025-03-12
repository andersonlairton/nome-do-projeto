<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresasUpdateRequest extends FormRequest
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
            //'codigo' => 'sometimes|numeric|unique:empresas',
            'empresa' => 'sometimes|numeric',
            'sigla' => 'sometimes|string|max:40',
            'razao_social' => 'sometimes|string|max:255',
        ];
    }

    /**
     * Mensagens personalizadas para os erros de validação.
     */
    public function messages()
    {
        return [
            'codigo.numeric' => 'O campo código deve ser um número.',
            'codigo.unique' => 'O código informado já está em uso.',
            'empresa.numeric' => 'O campo empresa deve ser um número.',
            'sigla.string' => 'A sigla deve ser um texto.',
            'sigla.max' => 'A sigla não pode ter mais de 40 caracteres.',
            'razao_social.string' => 'A razão social deve ser um texto.',
            'razao_social.max' => 'A razão social não pode ter mais de 255 caracteres.',
        ];
    }
}
