<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoGalleryAlbumUpdateRequest extends FormRequest
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
            'gallery_description'       => 'required',
        ];
    }

    public function messages(): array {
        return [
            'required.gallery_name'                 => 'O nome para a Galeria é obrigatório.',
            'unique.gallery_name'                   => 'Já exisste uma Galeria com esse nome.',
            'required.gallery_description'          => 'Informe uma descrição para o album.',
        ];
    }
}
