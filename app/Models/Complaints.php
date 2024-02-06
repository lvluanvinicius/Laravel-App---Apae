<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;

    /**
     * Referencia as colunas para inserção em massa.
     *
     * @var array
     */
    protected $fillable = ["name", "email", "tel", "subject", "message"];
}