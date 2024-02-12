<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIServices extends Model
{
    use HasFactory;

    /**
     * Referencia as colunas para inserção em massa.
     *
     * @var array
     */
    protected $fillable = [
        "file_name",
        "file_public",
        "file_type",
        "file_name_path",
        "file_size",
        "file_format",
        "file_hash",
        "file_device",
    ];
}