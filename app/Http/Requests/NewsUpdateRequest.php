<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            "news_post_slug"                                => "required",
            "news_post_summary"                             => "required",
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
        ];
    }
}
