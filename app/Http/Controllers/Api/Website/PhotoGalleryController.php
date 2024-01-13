<?php

namespace App\Http\Controllers\Api\Website;

use App\Exceptions\PhotoGalleryException;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Models\PhotoGalleryAlbum;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PhotoGalleryController extends Controller
{
    use ApiResponse;

    /**
     * Recupera todas as fotos de um album.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param PhotoGalleryAlbum $photoGallery
     * @param string $galleryId
     * @return JsonResponse
     */
    public function view(PhotoGalleryAlbum $photoGallery, string $galleryId): JsonResponse
    {
        try {
            $photos = $photoGallery->getImages($galleryId);
            return $this->success('Album recuperado com sucesso.', $photos);
        } catch (PhotoGalleryException $error) {
            return $this->error($error->getMessage(), Response::HTTP_OK);
        } catch (Exception $error) {
            return $this->error($error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}