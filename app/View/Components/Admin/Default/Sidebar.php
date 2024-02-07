<?php

namespace App\View\Components\Admin\Default;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Recebe o nome da aplicação.
     *
     * @var string
     */
    public string $appTitle;

    /**
     * Recebe a string da imagem do logotipo.
     *
     * @var string
     */ 
    public string $logoPath;

    /**
     * Create a new component instance.
     */
    public function __construct(string $logoPath)
    {
        $this->appTitle = env('APP_NAME');
        $this->logoPath = $logoPath;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.default.sidebar');
    }
}
