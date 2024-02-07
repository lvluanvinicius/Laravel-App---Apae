<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('pages.website.contact.index')->with([
            "title" => env('APP_NAME') . " | Contatos",
            "subtitle" => "Contatos",
        ]);
    }
}