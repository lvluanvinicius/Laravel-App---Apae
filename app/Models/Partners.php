<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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

    /**
     * Recupera os ultimos 3 registros.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @return Collection
     */
    public function getLatestPartners(): Collection
    {
        return $this->orderBy('created_at', 'desc')->limit(3)->get();
    }
}
