<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Guarda o nome do site/aplicação.
     *
     * @var string
     */
    public string $appName;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->appName = env('APP_NAME');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.sidebar');
    }
}
