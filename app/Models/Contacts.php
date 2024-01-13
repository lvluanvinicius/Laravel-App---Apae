<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    /**
     * Referencia as colunas para inserção em massa.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @var array
     */
    protected $fillable = [
        "city_uf",
        "email",
        "message",
        "name",
        "subject",
        "tel",
    ];

    /**
     * Cria um novo registro de contato.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param array $contact
     * @return boolean
     */
    public function createContact(array $contact): bool
    {
        $create = $this->create($contact);

        if ($create) return true;

        return false;
    }
}