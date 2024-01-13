<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PhotoGalleryAlbum;
use App\Models\PhotoGalleryFiles;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ApaeGalleryController extends Controller
{
    /**
     * Carrega a listagem de albuns.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @return View
     */
    public function index(): View
    {
        $gallery = PhotoGalleryAlbum::paginate(8);

        return view('pages.website.photo-gallery.index')->with([
            'title' => env('APP_NAME') . ' | Galeria de Fotos',
            'subtitle' => 'Galeria de Fotos',
            'galleries'     => $gallery
        ]);
    }

    /**
     * Recupera os detalhes e fotos da galeria para exibição.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $galleryId
     * @return View
     */
    public function view(string $galleryId): View
    {
        $gallery = PhotoGalleryAlbum::where('id', $galleryId)->first();
        $photos = PhotoGalleryFiles::where('cod_photo_gallery_fk', $gallery->id)->get();

        return view('pages.website.photo-gallery.view')->with([
            'title' => env('APP_NAME') . ' | Galeria de Fotos',
            'subtitle' => $gallery->gallery_name,
            'gallery' => $gallery,
            'photos' => $photos,
        ]);
    }
}