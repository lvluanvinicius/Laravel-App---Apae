<?php

namespace App\Repositories;

class NewsRepository implements \App\Interfaces\NewsRepositoryInterface

{
    /**
     * Recupera todos os registros.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string|null $search
     * @param integer $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function news(string | null $search, int $perPage = 10): \Illuminate\Pagination\LengthAwarePaginator
    {
        // Recuperando sem base na string de search.
        if (!$search) {
            return \App\Models\News::select([
                "users.name",
                "category.description",
                "category.category",
                "news.news_post_title",
                "news.news_post_content",
                "news.news_post_slug",
                "news.news_post_summary",
                "news.news_post_tags",
                "news.news_post_views",
                "news.news_post_status",
                "news.news_post_active_comments",
                "news.created_at",
            ])
                ->join('users', 'users.id', '=', 'news.cod_user_fk')
                ->join('category', 'category.id', '=', 'news.cod_category_fk')
                ->orderBy('news.created_at', 'desc')->paginate($perPage);
        }

        // Recuperando registro com base na string de search.
        return \App\Models\News::select([
            "users.name",
            "category.description",
            "category.category",
            "news.news_post_title",
            "news.news_post_content",
            "news.news_post_slug",
            "news.news_post_summary",
            "news.news_post_tags",
            "news.news_post_views",
            "news.news_post_status",
            "news.news_post_active_comments",
            "news.created_at",
        ])
            ->join('users', 'users.id', '=', 'news.cod_user_fk')
            ->join('category', 'category.id', '=', 'news.cod_category_fk')
            ->where(function ($query) use ($search) {
                if (strpos($search, '%') === false) {
                    $search = '%' . $search . '%';
                }

                $query->orWhere('LOWER(news.news_post_title) LIKE LOWER(?)', [$search])
                    ->orWhere('LOWER(news.news_post_content) LIKE LOWER(?)', [$search])
                    ->orWhere('LOWER(news.news_post_slug) LIKE LOWER(?)', [$search])
                    ->orWhere('LOWER(news.news_post_summary) LIKE LOWER(?)', [$search])
                    ->orWhere('LOWER(news.news_post_tags) LIKE LOWER(?)', [$search])
                    ->orWhere('LOWER(news.news_post_views) LIKE LOWER(?)', [$search])
                    ->orWhere('LOWER(news.news_post_status) LIKE LOWER(?)', [$search])
                    ->orWhere('LOWER(users.name) LIKE LOWER(?)', [$search])
                    ->orWhere('LOWER(category.description) LIKE LOWER(?)', [$search])
                    ->orWhere('LOWER(category.category) LIKE LOWER(?)', [$search]);
            })
            ->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Recupera um registro apenas para edição.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $id
     * @return \App\Models\News
     */
    public static function findForEdit(string $id): \App\Models\News
    {
        // Recuperando dados.
        $news = \App\Models\News::where('id', $id)->first();

        // Valida se localizou o registro para edição.
        !$news && throw new \App\Exceptions\NewsException('Noticia não localizada.');

        return $news;
    }

    /**
     * Excluí um registro.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $id
     * @return bool
     */
    public static function destroy(string $id): bool
    {
        // Recuperando post.
        $news = \App\Models\News::where('id', $id)->first();

        // Valida se localizou o post.
        if (!$news) {
            throw new \App\Exceptions\NewsException("Notícia não encontrada.");
        }

        if ($news->delete()) {
            return true;
        } else {
            return true;
        }
    }
}