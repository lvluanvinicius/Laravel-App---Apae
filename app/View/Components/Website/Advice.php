<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Advice extends Component
{
    public array $advices;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->advices = [
            [
                "office" => "Conselheiro Administrativo",
                "names" => [
                    "José Luis Figueiredo",
                    "Nilson Ferreira Neves",
                    "Mauro José Cadamuro Filho",
                    "Maria Cecília Bonifácio",
                ]
            ],
            [
                "office" => "Conselho Fiscal",
                "names" => [
                    "José Maria Barbosa",
                    "Aparecida Steinhardt",
                    "Maria Cristina Mazzante Machado",
                ],
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.advice');
    }
}
