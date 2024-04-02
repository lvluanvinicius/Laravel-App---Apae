<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransparencyUploadFilesRequest extends FormRequest
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
            'file' => 'required|file|max:20240',
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
            "file.required" => "Informe um arquivo para upload.",
            "file.uploaded" => "Tamanho para o arquivo não é aceito, sendo menor ou igual a 10Mb.",
        ];
    }
}