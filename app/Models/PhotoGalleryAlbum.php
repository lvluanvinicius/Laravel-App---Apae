<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nette\Utils\Arrays;

class PhotoGalleryAlbum extends Model
{
    use HasFactory;

    /**
     * Referencia a tabela ao modelo.
     *
     * @var string
     */
    protected $table = "photo_gallery";

    /**
     * Referencia os campos a inserção em massa.
     *
     * @var array
     */
    protected $fillable = [
        "gallery_name", "gallery_description", "gallery_hash", "gallery_size", "gallery_format", "gallery_image",
    ];

    /**
     * Carrega todas as imagens de um album.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $galleryId
     * @return Collection|array
     */
    public function getImages(string $galleryId): Collection|array
    {
        $photos = $this->select([
            'gallery_files.id as gallery_files_id',
            'gallery_files.filename',
            'gallery_files.hash',
            'photo_gallery.id as photo_gallery_id',
            'photo_gallery.gallery_name',
            'photo_gallery.gallery_description',
        ])
            ->join('gallery_files', 'gallery_files.cod_photo_gallery_fk', '=', 'photo_gallery.id')
            ->where('photo_gallery.id', $galleryId)->get();

        if (count($photos) <= 0) {
            return [];
        }

        return $photos;
    }
}