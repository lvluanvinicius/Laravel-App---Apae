<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonateNow extends Model
{
    use HasFactory;

     /**
     * Referencia o nome das colunas.
     *
     * @var array
     */
    protected $fillable = [
        "description", "image_name"
    ];
}