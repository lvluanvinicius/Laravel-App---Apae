<?php


namespace App\Repositories;

use App\Exceptions\SettingsException;


class SettingsRepository
{
    /**
     * Recupera um registro.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $setting
     * @return string|null
     */
    public static function getSetting(string $setting): string|null
    {
        // Recupetando configuração.
        $s = \App\Models\Settings::where('setting_name', $setting)->first('setting_value');

        // Valida se encontrou o registro.
        !$s && throw new SettingsException('Configurações não foram localizadas.');

        return $s->setting_value;
    }


}