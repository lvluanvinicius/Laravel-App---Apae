<?php

namespace App\Repositories\Blog;

class PostsRepository
{
    /**
     * Recupera todos os posts em paginação.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $query_filter
     * @param integer $perPage
     * @return void
     */
    public static function posts(string $search, int $perPage = 20): \Illuminate\Pagination\LengthAwarePaginator
    {
        return \App\Models\News::select([
            "news.id",
            "news.cod_user_fk",
            "news.cod_category_fk",
            "news.news_post_title",
            "news.news_post_content",
            "news.news_post_slug",
            "news.news_post_summary",
            "news.news_post_tags",
            "news.news_post_views",
            "news.news_post_status",
            "news.news_post_active_comments",
            "news.created_at",
            "news.cod_photo_gallery_fk",
        ])
            ->where(function ($query) use ($search) {
                $query->orWhereRaw("LOWER(news.news_post_title) LIKE LOWER(?)", [$search])
                    ->orWhereRaw("LOWER(news.news_post_content) LIKE LOWER(?)", [$search])
                    ->orWhereRaw("LOWER(news.news_post_slug) LIKE LOWER(?)", [$search])
                    ->orWhereRaw("LOWER(news.news_post_summary) LIKE LOWER(?)", [$search])
                    ->orWhereRaw("LOWER(news.news_post_tags) LIKE LOWER(?)", [$search])
                    ->orWhereRaw("LOWER(news.news_post_views) LIKE LOWER(?)", [$search])
                    ->orWhereRaw("LOWER(news.news_post_status) LIKE LOWER(?)", [$search])
                    ->orWhereRaw("LOWER(news.news_post_active_comments) LIKE LOWER(?)", [$search]);
            })
            ->paginate($perPage);
    }

    /**
     * Recupera um post pelo slug.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $newsPostSlug
     * @return \App\Models\News
     */
    public static function getPostPerSlug(string $newsPostSlug): \App\Models\News
    {
        // Recuperando post.
        $post = \App\Models\News::select([
            'news.id as news_id',
            "news.news_post_title",
            "news.news_post_content",
            "news.news_post_slug",
            "news.news_post_summary",
            "news.news_post_tags",
            "news.news_post_views",
            "news.news_post_status",
            "news.news_post_active_comments",
            "news.cod_photo_gallery_fk",

            "users.name as users_name",
            "category.description as category_description",
        ])->where('news_post_slug', $newsPostSlug)
            ->join('users', 'users.id', '=', 'news.cod_user_fk')
            ->join('category', 'category.id', '=', 'news.cod_category_fk')
            ->first();

        // Valida se o post foi localizado.
        if (!$post) {
            throw new \App\Exceptions\NewsException('Post não encontrado.');
        }

        // Recuperando galeria de fotos se houver.
        if ($post->cod_photo_gallery_fk) {
            $post->gallery_data = \App\Repositories\PhotoGalleryRepository::getGalleryPerId($post->cod_photo_gallery_fk);
        }

        return $post;
    }
}