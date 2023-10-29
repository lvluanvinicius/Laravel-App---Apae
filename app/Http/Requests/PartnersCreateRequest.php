<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnersCreateRequest extends FormRequest
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
            'partner_name'                          => 'required|unique:partners,partner_name,except,id',
            'partner_image'                         => 'required',
        ];
    }

    public function messages()
    {
        return [
            'partner_name.required'                 => 'O Nome para o parceiro é obrigatório.',
            'partner_name.unique'                   => 'Já existe um parceiro com esse nome.',
            'partner_image.required'                => 'O Nome para o parceiro é obrigatório.',
        ];
    }
}
