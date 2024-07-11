<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCresteUserRequest extends FormRequest
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
            "name" => "required",
            "rule" => "required",
            "email" => 'required|email|unique:users,email,except,id',
            "password" => "required",
            "is_client" => "required",
        ];
    }

    /**
     * Retorna as mensagens de erros.
     * Instanciado para alterar em customização.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            "name.required" => "O nome para o usuário é obrigatório.",
            "rule.required" => "Informe uma regra para o usuário.",
            "email.required" => "O e-mail para acesso é obrigatório.",
            "email.email" => "O e-mail informado é inválido.",
            "email.unique" => "O e-mail informado já está sendo utilizado.",
            "is_client.required" => "Informe se é um usuário interno ou comum,",
        ];
    }
}

// luan@grupocednet.com.br