<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Sliders;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Sliders::where('sliders_active', true)->get();

        return view('pages.website.home.index')->with([
            'title'             => env('APP_NAME'),
            'sliders'           => $sliders,
        ]);
    }
}