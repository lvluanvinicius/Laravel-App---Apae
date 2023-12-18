<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * Referencia o nome da tabela.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * Referencia o nome das colunas.
     *
     * @var array
     */
    protected $fillable = [
        "news_post_title",
        "news_post_content",
        "news_post_slug",
        "news_post_summary",
        "news_post_tags",
        "news_post_views",
        "news_post_status",
        "news_post_active_comments",
        "cod_user_fk",
        "cod_category_fk",
    ];
}
