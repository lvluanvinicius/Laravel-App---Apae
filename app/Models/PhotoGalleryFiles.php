<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGalleryFiles extends Model
{
    use HasFactory;

    /**
     * Referencia a tabela ao modelo.
     *
     * @var string
     */
    protected $table = "gallery_files";

    /**
     * Referencia os campos a inserção em massa.
     *
     * @var array
     */
    protected $fillable = [
        "cod_photo_gallery_fk", "filename", "hash", "type_file", "size_file",
    ];
}
