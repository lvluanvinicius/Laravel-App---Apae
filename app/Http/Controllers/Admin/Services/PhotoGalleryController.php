<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;

class PhotoGalleryController extends Controller
{
    use \App\Traits\ApiResponse;

    /**
     * Retorna as galerias.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param \Illuminate\Http\Request $request [explicite description]
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Recupetando parametros da requisição e valor se houver.
            $search = $request->has('q') ? $request->get('q') : null;
            $perPage = $request->has('per_page') ? $request->get('per_page') : 20;

            // REcuperando registros.
            $galleries = \App\Repositories\PhotoGalleryRepository::galleries($search, $perPage);

            return $this->success('Galerias recuperadas com sucesso.', $galleries);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }
}