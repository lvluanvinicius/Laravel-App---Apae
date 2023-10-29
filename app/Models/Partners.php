<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    use HasFactory;

    /**
     * Referencia o nome da tabela.
     *
     * @var string
     */
    protected $table = 'partners';

    /**
     * Referencia o nome das colunas.
     *
     * @var array
     */
    protected $fillable = [
        "partner_name",
        "partner_image",
        "partner_image_size",
        "partner_image_type",
        "partner_hash",
    ];
}
