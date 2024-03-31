<?php

namespace App\Repositories\Blog;

class PostsRepository
{
    public static function posts(string $query_filter)
    {
        return \App\Models\News::query($query_filter);
    }
}