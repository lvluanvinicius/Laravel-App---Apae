<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            "news_post_title"                               => "required",
            "cod_category_fk"                               => "required",
            "news_post_content"                             => "required",
            "news_post_summary"                             => "required",
            "news_post_slug"                                => "required|unique:news,news_post_slug,except,id",
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
            "news_post_title.required"                       => "O título do post é obrigatório.",
            "cod_category_fk.required"                       => "A categoria do post é obrigatória.",
            "news_post_content.required"                     => "O conteúdo do post é obrigatório.",
            "news_post_slug.required"                        => "O slug do post é obrigatório.",
            "news_post_slug.unique"                          => "O slug informado já existe.",
        ];
    }
}
