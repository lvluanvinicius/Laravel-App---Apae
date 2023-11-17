<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Retorna o display de listagens de notícias.
     *
     * @return View
     */
    public function index(): View
    {
        return view("pages.admin.news.index")->with([
            'title'             => 'Notícias',
        ]);
    }
}
