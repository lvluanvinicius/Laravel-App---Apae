<?php


namespace App\Interfaces;

interface SIServicesRepositoryInterface
{
    public function getAll(string|null $search, int $paginate): \Illuminate\Pagination\LengthAwarePaginator;
    public function getFile(string $pathFile): \Illuminate\Http\Response;
    public static function getFileData(array $id): \Illuminate\Database\Eloquent\Collection;
    public static function saveFile(array $data_file): bool;
}