<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    /**
     * Exibe o display de Contato.
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.website.contact.index')->with([
            "title" => env('APP_NAME') . " | Contatos",
            "subtitle" => "Contatos",
        ]);
    }

    /**
     * Exibe o display de Ouvidoria.
     *
     * @return View
     */
    public function ombudsman(): View
    {
        return view('pages.website.ombudsman.index')->with([
            "title" => env('APP_NAME') . " | Ouvidoria",
            "subtitle" => "Ouvidoria",
        ]);
    }
}