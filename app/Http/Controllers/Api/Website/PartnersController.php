<?php

namespace App\Http\Controllers\Api\Website;

use App\Exceptions\PartnersException;
use App\Http\Controllers\Controller;

class PartnersController extends Controller
{
    use \App\Traits\ApiResponse;

    public function partnersSlider(): \Illuminate\Http\JsonResponse
    {
        try {
            $partners = \App\Models\Partners::get();

            // Configurando URL de exibição de imagem.
            for ($ind = 0; $ind < count($partners); $ind++) {
                $partners[$ind]->partner_image = env('APP_URL') . "/images/partners/" . $partners[$ind]->partner_image;
            }

            return $this->success('Parceiros recuperados com sucesso.', $partners);
        } catch (PartnersException $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }
}