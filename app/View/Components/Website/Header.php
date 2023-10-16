<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Recebe o nome da aplicação.
     *
     * @var string
     */
    public string $appTitle;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->appTitle = env('APP_NAME');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.header');
    }
}
