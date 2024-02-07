<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View ;

class AApaeController extends Controller
{
    /**
     * Carrega a página institucional.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @return View
     */
    public function institutional(): View
    {
        return view('pages.website.aapae.institutional')->with([
            'title' => env('APP_NAME') . ' | Institucional',
            'subtitle' => 'Institucional',
        ]);
    }

    /**
     * Carrega a página de diretores.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @return View
     */
    public function direction(): View
    {
        return view('pages.website.aapae.direction')->with([
            'title' => env('APP_NAME') . ' | Diretoria',
            'subtitle' => 'Diretoria',
        ]);
    }

    /**
     * Lista todos os membros do conselho.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @return View
     */
    public function advice(): View
    {
        return view('pages.website.aapae.advice')->with([
            'title' => env('APP_NAME') . ' | Conselho',
            'subtitle' => 'Conselho',
        ]);
    }

    /**
     * Carrega o estatuto.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @return View
     */
    public function statute(): View
    {
        return view('pages.website.aapae.statute')->with([
            'title' => env('APP_NAME') . ' | Estatuto',
            'subtitle' => 'Estatuto',
        ]);
    }
}
