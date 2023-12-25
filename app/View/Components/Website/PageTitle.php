<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageTitle extends Component
{
    /**
     * Guarda o nome da página.
     *
     * @var string
     */
    public string $title;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.page-title');
    }
}
