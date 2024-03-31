<?php

namespace App\Interfaces;

interface NewsRepositoryInterface
{
    public static function news(string | null $search, int $perPage = 10): \Illuminate\Pagination\LengthAwarePaginator;
    public static function findForEdit(string $id): \App\Models\News;

}