<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
