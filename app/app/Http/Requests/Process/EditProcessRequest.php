<?php

namespace App\Http\Requests\Process;

use Illuminate\Foundation\Http\FormRequest;

class EditProcessRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

     public function rules(): array
    {
        return [
            'id'                => 'required',
            'editTituloProcesso'    => 'required|string|max:255',
            'editFormFile'          => 'nullable',
            'editDescricaoProcesso' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'editTituloProcesso.required' => 'O titulo é obrigatório.',
            'editTituloProcesso.string'   => 'O titulo deve ser um texto.',
            'editTituloProcesso.max'      => 'O titulo não pode ter mais de 255 caracteres.',

            'editDescricaoProcesso.required' => 'A descricao é obrigatória.',
            'editDescricaoProcesso.string'   => 'A descricao deve ser um texto.',
            'editDescricaoProcesso.max'      => 'A descricao não pode ter mais de 255 caracteres.',
        ];
    }
}
