<?php

namespace App\Http\Requests\Process;

use Illuminate\Foundation\Http\FormRequest;

class RegisterProcessRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

     public function rules(): array
    {
        return [
            'tituloProcesso'  => 'required|string|max:255',
            'formFile' => 'required',
            'descricaoProcesso' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'tituloProcesso.required' => 'O titulo é obrigatório.',
            'tituloProcesso.string'   => 'O titulo deve ser um texto.',
            'tituloProcesso.max'      => 'O titulo não pode ter mais de 255 caracteres.',

            'formFile.required'       => 'O arquivo é obrigatório.',

            'descricaoProcesso.required' => 'A descricao é obrigatória.',
            'descricaoProcesso.string'   => 'A descricao deve ser um texto.',
            'descricaoProcesso.max'      => 'A descricao não pode ter mais de 255 caracteres.',
        ];
    }
}
