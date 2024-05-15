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

            return $this->success('Parceiros recuperados com sucesso.', $partners);
        } catch (PartnersException $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }
}
