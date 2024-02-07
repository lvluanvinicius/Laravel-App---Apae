<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnersUpdateRequest extends FormRequest
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
            'partner_name'                          => 'required',
        ];
    }

    /**
     * Traduz as mensagens de erros.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'partner_name.required'                 => 'O Nome para o parceiro é obrigatório.',
        ];
    }
}
