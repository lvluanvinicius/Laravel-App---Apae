<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Referencia o nome da tabela.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * Referencia o nome das colunas.
     *
     * @var array
     */
    protected $fillable = [
        "description",
        "category",
    ];
}
