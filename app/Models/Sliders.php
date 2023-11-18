<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    use HasFactory;

    /**
     * Referencia a tabela do modelo.
     *
     * @var string
     */
    protected $table = "sliders";

    /**
     * Referencia os campos com inserção em massa.
     *
     * @var array
     */
    protected $fillable = [
        'sliders_hash',
        'sliders_size',
        'sliders_image',
        'sliders_format',
    ];
}
