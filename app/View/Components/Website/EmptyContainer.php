<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyContainer extends Component
{
    /**
     * Guarda a descrição do container.
     *
     * @var string
     */
    public string $description;

    /**
     * Guarda o nome do icone de fundo.
     *
     * @var string
     */
    public string $icon;

    /**
     * Create a new component instance.
     */
    public function __construct(string $description, string $icon = "fa-folder")
    {
        $this->description = $description;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.empty-container');
    }
}