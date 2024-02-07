<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category'                      => 'required|unique:category,category,except,id',
            'description'                   => 'required',
        ];
    }

    /**
     * Altera as mensagens de retorno.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'category.required'              => 'Categoria é obrigatória.',
            'category.unique'                => 'Já existe uma categoria com esse nome.',
            'description.required'           => 'Categoria Slug é obrigatório.',
        ];
    }
}
