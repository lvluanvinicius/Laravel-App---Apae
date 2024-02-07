<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Exceptions\ContactException;
use App\Models\Contacts;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    use ApiResponse;

    /**
     * Cria um novo contato enviamdo pelo frontend.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param Contacts $contacts
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Contacts $contacts, Request $request): JsonResponse
    {
        try {
            // Recuperando dados da requisição.
            $requestData = $request->only(["name", "email", "tel", "city_uf", "subject", "message"]);

            // Criando registro.
            $register =  $contacts->createContact($requestData);

            // Validando criação.
            if (!$register) throw new ContactException('Houve um erro ao tentar registrar seu contato. Por favor, tente novamente.');

            return $this->success("Seu contato foi registrado com sucesso.");
        } catch (ContactException $error) {
            return $this->error($error->getMessage(), Response::HTTP_OK);
        } catch (Exception $error) {
            return $this->error($error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

}