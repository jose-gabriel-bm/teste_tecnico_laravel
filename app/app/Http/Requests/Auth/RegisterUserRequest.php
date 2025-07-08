<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'O nome é obrigatório.',
            'name.string'    => 'O nome deve ser um texto.',
            'name.max'       => 'O nome não pode ter mais de 255 caracteres.',
            
            'email.required' => 'O e-mail é obrigatório.',
            'email.email'    => 'O e-mail deve ser um endereço válido.',
            'email.unique'   => 'Esse e-mail já está cadastrado.',
            
            'password.required'  => 'A senha é obrigatória.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'password.min'       => 'A senha deve ter no mínimo 6 caracteres.',
        ];
    }
}
