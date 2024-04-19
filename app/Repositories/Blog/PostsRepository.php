<?php

namespace App\Repositories\Blog;

class PostsRepository
{
    public static function posts(string $query_filter, int $perPage = 20)
    {
        return \App\Models\News::query($query_filter)->paginate();
    }
}