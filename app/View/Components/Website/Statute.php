<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Statute extends Component
{
    /**
     * Guarda o estatuto ativo.
     *
     * @var \App\Models\Statute|null
     */
    public \App\Models\Statute|null $statute;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Recuperando registro do estatuto.
        $this->statute = (new \App\Models\Statute())->where('status', true)->first();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.website.statute');
    }
}
