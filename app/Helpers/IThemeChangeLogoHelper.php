<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Vite;

class IThemeChangeLogoHelper {
    /**
     * Recupera a imagem do logo do app em acordo com o tema que está configurado no perfil
     * do usuário.
     *
     * @return string
     */
    public function changeTheme(): string
    {
        $img = "";                          # Guarda a string da imagem para retornar.

        // Retorna a string da logo branca se o tema for light.
        if (auth()->user()->ui_theme === "light") $img = Vite::appImages('logo-preta.webp');
        // Retorna a string da logo preta se o tema for dark.
        if (auth()->user()->ui_theme === "dark") $img = Vite::appImages('logo-branca.webp');
        
        return $img;
    }
}