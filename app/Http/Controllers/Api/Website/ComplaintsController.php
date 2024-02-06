<?php

namespace App\Http\Controllers\Api\Website;

use App\Exceptions\ComplaintsException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ComplaintsController extends Controller
{
    use \App\Traits\ApiResponse;

    /**
     * Cria um novo registro de contato anonimo.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function complaints(Request $request): JsonResponse
    {
        try {
            // Recuperando dados da requisição.
            $requestData = $request->only(["name", "email", "tel", "subject", "message"]);

            \App\Repositories\ComplaintsRepository::sendMail($requestData);
            // Criando registro.
            // $register = \App\Repositories\ComplaintsRepository::register($requestData);

            // Validando criação.
            // if (!$register)
            //     throw new ComplaintsException('Houve um erro ao tentar registrar sua denúncia. Por favor, tente novamente.');

            return $this->success("Seu contato foi registrado com sucesso.");
        } catch (ComplaintsException $error) {
            return $this->error($error->getMessage(), Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}