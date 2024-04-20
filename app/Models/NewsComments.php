<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsComments extends Model
{
    use HasFactory;

    /**
     * Referencia os campos para inserção em massa.
     *
     * @var array
     */
    protected $fillable = [
        'news_id',
        'comment',
        'name',
        'email',
    ];

}