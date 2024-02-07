<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Direction extends Component
{
    public array $directions;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->directions = [
            ["name" => "Carlos Alberto Delafiori", "office" => "Presidente"],
            ["name" => "Jacira Gonçalves Queiroz", "office" => "Vice Presidente"],
            ["name" => "Denize Bertozzi Lazarini", "office" => "1ª Diretora Secretaria"],
            ["name" => "Fernanda Bertelli de Oliveira Ferreira", "office" => "2ª Diretora Secretaria"],
            ["name" => "Cleide de Almeida Mastrandéa Cadamuro", "office" => "1º Diretor Financeiro"],
            ["name" => "Ilda Maria dos Santos", "office" => "2º Diretor Financeiro"],
            ["name" => "Felipe Tada Bertellia", "office" => "Diretor de Patrimônio"],
            ["name" => "Vanessa Nogueira Geraldo", "office" => "Diretora Social"],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.direction');
    }
}
