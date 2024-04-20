<?php

namespace App\Interfaces;

interface NewsCommentsRepositoryInterface
{
    public function getAllOfPost(string $postId);
    public function createNewComment(array $attr, string $postId);
}