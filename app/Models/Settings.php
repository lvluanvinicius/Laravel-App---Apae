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
        "setting_name", "setting_value", "setting_type"
    ];

    /**
     * Atualiza um registro de configuração pelo setting_name.
     *
     * @param string $name
     * @param array $values
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return boolean
     */
    public function updateSettings(string $name, array $values): bool
    {
        $setting = $this->where('setting_name', $name)->update($values);

        if ($setting) return true;

        return false;
    }
}