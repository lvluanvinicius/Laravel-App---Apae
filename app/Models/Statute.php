<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statute extends Model
{
    use HasFactory;

    /**
     * Referencia a tabela para o modelo.
     *
     * @var string
     */
    protected $table = "statute";

    /**
     * Referencia as colunas para inserção em massa.
     *
     * @var array
     */
    protected $fillable = [
        "name", "status", "file_name",
    ];
}
