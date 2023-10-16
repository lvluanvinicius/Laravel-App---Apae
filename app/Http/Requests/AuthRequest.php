<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email'     => ['required'],
            'password'  => ['required'],
        ];
    }

    /**
     * retorna todas as mensagens de erros customizadas.
     *
     * @return void
     */
    public function messages() 
    {
        return [
            'email.required'            => 'Endereço de e-mail obrigatório.',
            'password.required'         => 'Senha de acesso obrigatória.',
        ];
    }
}
