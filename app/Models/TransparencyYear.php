<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransparencyYear extends Model
{
    use HasFactory;

    /**
     * Guarda o nome da tabela referenciada ao modelo.
     *
     * @var string
     */
    protected $table = "transparency_year";

    /**
     * Guarda o nome dos campos que receberão inserção.
     *
     * @var array
     */
    protected $fillable = [
        "year_folder"
    ];
}
