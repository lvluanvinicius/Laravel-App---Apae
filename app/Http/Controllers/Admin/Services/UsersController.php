<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    use \App\Traits\ApiResponse;

    /**
     * Guarda o repositório de Usuários.
     *
     * @author Luan VP Santos <lvluansantos@gmail.com>
     *
     * @var \App\Repositories\UserRepository
     */
    public \App\Repositories\UserRepository $userRepository;

    /**
     * Inicia o contrutor.
     *
     * @author Luan VP Santos <lvluansantos@gmail.com>
     *
     * @param \App\Repositories\UserRepository $userRepository
     */
    public function __construct(
        \App\Repositories\UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Retorna os usuários.
     *
     * @author Luan VP Santos <lvluansantos@gmail.com>
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Recuperando dados da requisição.
            $search = $request->get('search') ?? null;
            $perPage = $request->get('per_page') ?? 20;

            $users = $this->userRepository->getUsers($search, $perPage);

            return $this->success("Usuários recuperados com sucesso.", $users);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Cria um novo usuário.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param \App\Http\Requests\Admin\ServiceCresteUserRequest $request
     */
    public function store(\App\Http\Requests\Admin\ServiceCresteUserRequest $request)
    {
        try {
            // Recuperando dados da requisição.
            $requestData = $request->only(["name", "rule", "email", "password", "is_client"]);

            $users = $this->userRepository->createUser($requestData);

            return $this->success("Usuário criado com sucesso.", $users);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}