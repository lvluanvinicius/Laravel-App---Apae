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
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return View
     */
    public function index(): View
    {
        return view("pages.admin.news.index")->with([
            'title'             => 'Notícias',
        ]);
    }

    public function create() {
        return view("pages.admin.news.create")->with([
            'title'             => 'Nova Publicação',
        ]);
    }
}
