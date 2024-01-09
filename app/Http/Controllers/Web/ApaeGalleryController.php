<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PhotoGalleryAlbum;
use Illuminate\Http\Request;

class ApaeGalleryController extends Controller
{
    public function index() {
        $gallery = PhotoGalleryAlbum::paginate(2);

        return view('pages.website.photo-gallery.index')->with([
            'title'         => 'Galeria de Fotos',
            'galleries'     => $gallery
        ]);
    }
}
