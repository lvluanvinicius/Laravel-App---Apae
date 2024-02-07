<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WebLayout extends Component
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
     * Create a new component instance.
     */
    public function __construct(string $pageTitle)
    {
        $this->appTitle = env('APP_NAME');
        $this->pageTitle = $pageTitle;
        // $this->pageTitle = env('APP_NAME') . " | " . $pageTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.web-layout');
    }
}
