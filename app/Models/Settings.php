<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    /**
     * Referencia a tabela do modelo.
     *
     * @var string
     */
    protected $table = "settings";

    /**
     * Referencia os campos com inserção em massa.
     *
     * @var array
     */
    protected $fillable = [
        "setting_name", "setting_value"
    ];
}
