<?php

namespace App\View\Components\Admin;

use App\Helpers\IThemeChangeLogoHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppDefault extends Component
{
    /**
     * Recebe o nome da aplicação.
     *
     * @var string
     */
    public string $appTitle;
    /**
     * Recebe o título da página.
     *
     * @var string
     */
    public string $pageTitle;

    /**
     * Recebe o tema do layout
     *
     * @var string
     */
    public string $iThemes;

    /**
     * Recebe a string da logotipo.
     *
     * @var string
     */
    public string $logoPath;

    /**
     * Create a new component instance.
     */
    public function __construct(string $pageTitle)
    {
        $this->appTitle = env('APP_NAME');
        $this->pageTitle = env('APP_NAME') . " | " . $pageTitle;
        $this->iThemes = auth()->user()->ui_theme;

        // Recuperando imagem do logo em acordo com o tema configurado no perfil do usuário.
        $iThemeChange = new IThemeChangeLogoHelper();
        $this->logoPath = $iThemeChange->changeTheme();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.app-default');
    }
}
