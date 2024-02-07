<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Partners extends Component
{
    /**
     * Guarda os dados de parceiros.
     *
     * @var Collection
     */
    public Collection  $partners_data;

    /**
     * Create a new component instance.
     */
    public function __construct(\App\Models\Partners $partners)
    {
        $this->partners_data = $partners->getLatestPartners();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.partners');
    }
}
