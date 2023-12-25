<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DonateNow extends Component
{
    public string $buttonText;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->buttonText = "Doar Agora";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.donate-now');
    }
}
