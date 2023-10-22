<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransparencyFolders extends Model
{
    use HasFactory;

    /**
     * Guarda o nome da tabela referenciada ao modelo.
     *
     * @var string
     */
    protected $table = "transparency_folders";

    /**
     * Guarda o nome dos campos que receberão inserção.
     *
     * @var array
     */
    protected $fillable = [
        "cod_transparency_year_fk",
        "folders",
        "hash",
    ];
}
