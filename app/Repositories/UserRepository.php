<?php

namespace App\Repositories;

class UserRepository extends \App\Interfaces\UserRepositoryInterface

{
    /**
     * Guarda modelo de User.
     *
     * @author Luan VP Santos <lvluansantos@gmail.com>
     *
     * @var \App\Models\User
     */
    public \App\Models\User $user;

    /**
     * Inicia o construtor.
     *
     * @author Luan VP Santos <lvluansantos@gmail.com>
     *
     * @param \App\Models\User $user
     */
    public function __construct(\App\Models\User $user)
    {
        $this->user = $user;
    }

    /**
     * 
     * Recupera todos os usuários. 
     * 
     * @author Luan VP Santos <lvluansantos@gmail.com>
     * 
     * @param string|null $search
     * @param int $perPage
     * 
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUsers(string | null $search, int $perPage): \Illuminate\Pagination\LengthAwarePaginator
    {
        // Criando query de usuário.
        $userQuery = $this->user->query();

        // Ordenando por data de criação.
        $userQuery->orderBy("created_at", "desc");

        // Validando search se o retorno será com filtro.
        if (!$search) {
            return $userQuery->paginate($perPage);
        }

        // Inserindo filtros.
        $userQuery->where(function ($query) use ($search) {
            $query
                ->orWhereRaw("LOWER(users.name) LIKE LOWER(?)", [$search])
                ->orWhereRaw("LOWER(users.email) LIKE LOWER(?)", [$search])
                ->orWhereRaw("LOWER(users.ui_theme) LIKE LOWER(?)", [$search]);
        });

        return $userQuery->paginate($perPage);

    }
}
