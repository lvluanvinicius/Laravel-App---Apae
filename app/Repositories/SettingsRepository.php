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

    /**
     * Atualiza as configurações do servidor de e-mail.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $key
     * @param string $value
     * @return \App\Models\Settings
     */
    public static function updateMailServer(string $key, string $value): \App\Models\Settings
    {
        // Recupetando configuração.
        $s = \App\Models\Settings::where('setting_name', $key)->first();

        // Valida se encontrou o registro.
        !$s && throw new SettingsException('Configurações não foram localizadas.');

        // Populando novo valor de configuração.
        $s->setting_value = $value;

        // Valida se as configurações foram salvas corretamente.
        !$s->save() && throw new SettingsException('Erro ao tentar salvar as novas configurações.');

        return $s;
    }

}