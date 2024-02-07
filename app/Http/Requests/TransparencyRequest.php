<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransparencyRequest extends FormRequest
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
            "year_folder"                   => "required|unique:transparency_year,year_folder,except,id",
        ];
    }

    public function messages()
    {
        return [
            "year_folder.required"          => "O ano é obrigatório.",
            "year_folder.unique"          => "O ano informado já está dentro da transparência.",
        ];
    }
}
