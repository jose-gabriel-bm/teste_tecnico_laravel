<?php

namespace App\Http\Requests\Signatario;

use Illuminate\Foundation\Http\FormRequest;

class RegisterSignatoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

     public function rules(): array
    {
        return [
            'signatarioName'  => 'required|string|max:255',
            'signatarioEmail' => 'required|email',
            'signatarioCargo' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'signatarioName.required' => 'O nome é obrigatório.',
            'signatarioName.string'   => 'O nome deve ser um texto.',
            'signatarioName.max'      => 'O nome não pode ter mais de 255 caracteres.',

            'signatarioEmail.required' => 'O e-mail é obrigatório.',
            'signatarioEmail.email'    => 'O e-mail deve ser um endereço válido.',

            'signatarioCargo.required' => 'O cargo é obrigatório.',
            'signatarioCargo.string'   => 'O cargo deve ser um texto.',
            'signatarioCargo.max'      => 'O cargo não pode ter mais de 255 caracteres.',
        ];
    }
}
