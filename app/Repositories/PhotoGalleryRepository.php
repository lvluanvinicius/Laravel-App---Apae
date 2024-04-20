<?php

namespace App\Repositories;

class PhotoGalleryRepository implements \App\Interfaces\PhotoGalleryRepositoryInterface

{
    /**
     * Recupera os registros de galeria.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $search // String de Filtro.
     * @param int $perPage // Número de registros por página.
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public static function galleries(string | null $search, int $perPage = 20): \Illuminate\Pagination\LengthAwarePaginator
    {
        // Validando se existe valor no search.
        if (!$search) {
            return \App\Models\PhotoGalleryAlbum::orderBy('gallery_name', 'asc')->paginate($perPage);
        }

        return \App\Models\PhotoGalleryAlbum::where(function ($query) use ($search) {
            if (strpos($search, '%') === false) {
                $search = '%' . $search . '%';
            }

            $query->whereRaw('LOWER(gallery_name) LIKE LOWER(?)', [$search])
                ->orWhereRaw('LOWER(gallery_description) LIKE LOWER(?)', [$search])
                ->orWhereRaw('LOWER(gallery_hash) LIKE LOWER(?)', [$search]);
        })
            ->orderBy('gallery_name', 'asc')->paginate($perPage);
    }

    /**
     * Recupera os registros de galeria por ID.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $id
     * @return \App\Models\PhotoGalleryAlbum
     */
    public static function getGalleryPerId(string $id): \App\Models\PhotoGalleryAlbum  | null
    {
        return \App\Models\PhotoGalleryAlbum::where('id', $id)->first();
    }
}