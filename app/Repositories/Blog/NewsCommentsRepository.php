<?php

namespace App\Repositories\Blog;

use App\Exceptions\NewsCommentsException;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsCommentsRepository implements \App\Interfaces\NewsCommentsRepositoryInterface

{

    /**
     * Retorna todos os comentarios de um post.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $postId
     * @return void
     */
    public function getAllOfPost(string $postId): LengthAwarePaginator
    {
        // Recuperando registros.
        return \App\Models\NewsComments::where('news_id', $postId)->orderBy('created_at', 'desc')->paginate(20);
    }

    /**
     * Cria um novo comentario para um post.
     *
     * @param array $attr
     * @param string $postId
     * @return \App\Models\NewsComments
     */
    public function createNewComment(array $attr, string $postId): \App\Models\NewsComments
    {
        // Criando registro.
        $create = \App\Models\NewsComments::create(array_merge($attr, ['news_id' => $postId]));

        // Validando se foi criado corretamente.
        if (!$create) {
            throw new NewsCommentsException('Erro ao criar comentário.');
        }

        return $create;
    }
}