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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
