<?php

namespace App\Http\Requests\Signatario;

use Illuminate\Foundation\Http\FormRequest;

class EditSignatoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

     public function rules(): array
    {
        return [
            'id'  => 'required',
            'editSignatarioName'  => 'required|string|max:255',
            'editSignatarioEmail' => 'required|email',
            'editSignatarioCargo' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'editSignatarioName.required' => 'O nome é obrigatório.',
            'editSignatarioName.string'   => 'O nome deve ser um texto.',
            'editSignatarioName.max'      => 'O nome não pode ter mais de 255 caracteres.',

            'editSignatarioEmail.required' => 'O e-mail é obrigatório.',
            'editSignatarioEmail.email'    => 'O e-mail deve ser um endereço válido.',

            'editSignatarioCargo.required' => 'O cargo é obrigatório.',
            'editSignatarioCargo.string'   => 'O cargo deve ser um texto.',
            'editSignatarioCargo.max'      => 'O cargo não pode ter mais de 255 caracteres.',
        ];
    }
}
