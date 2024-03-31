<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoGalleryAlbumRequest extends FormRequest
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
            'gallery_name'              => 'required|unique:photo_gallery,gallery_name,except,id',
            'gallery_description'       => 'required',
        ];
    }

    /**
     * Traduz as frases de erro.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return array
     */
    public function messages(): array
    {
        return [
            'gallery_name.required'                 => 'O nome para a Galeria é obrigatório.',
            'gallery_name.unique'                   => 'Já exisste uma Galeria com esse nome.',
            'gallery_description.required'          => 'Informe uma descrição para o album.',
        ];
    }
}