<?php

namespace App\Http\Controllers\Api\Blog;

use App\Exceptions\NewsCommentsException;
use App\Exceptions\NewsException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PostsController extends Controller
{
    use \App\Traits\ApiResponse;

    /**
     * Recupera todos os posts.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function index(\Illuminate\Http\Request $request)
    {
        // Variavel string.
        $query_string = "";
        $paginate = $request->get('per_page') ?? 20;
        $search = $request->get('search') ?? null;
        $order = 'news_post_title';

        // Inserindo porcentagem se não houver.
        if (strpos($search, '%') === false) {
            // Aplicando porcentagem.
            $search = '%' . $search . '%';
        }

        // Recuperando registros.
        $posts = \App\Repositories\Blog\PostsRepository::posts($search, $paginate);

        return $this->success('', $posts);
    }

    /**
     * Recupera todos os comentários de um post.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $postId
     * @return JsonResponse
     */
    public function comments(string $slug): JsonResponse
    {
        try {
            // Recuperando post.
            $post = \App\Repositories\Blog\PostsRepository::getPostPerSlug($slug);

            // Recuperando comentários.
            $comments = (new \App\Repositories\Blog\NewsCommentsRepository())->getAllOfPost($post->news_id);

            return $this->success('Comentários recuperados com sucesso.', $comments);
        } catch (NewsException $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Cria um novo comentário para um post.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param \App\Http\Requests\NewsCommentsCreateRequest $request
     * @param string $postId
     * @return JsonResponse
     */
    public function createComment(\App\Http\Requests\NewsCommentsCreateRequest $request, string $slug): JsonResponse
    {
        try {
            // Recuperando dados do request.
            $requestData = $request->only([
                'comment',
                'name',
                'email',
            ]);

            // Recuperando post.
            $post = \App\Repositories\Blog\PostsRepository::getPostPerSlug($slug);

            // Criando comentário.
            $comments = (new \App\Repositories\Blog\NewsCommentsRepository())->createNewComment($requestData, $post->news_id);

            return $this->success('Comentário criado com sucesso.', $comments);
        } catch (NewsCommentsException $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Recupera apenas um post pelo slug.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function getPostPerSlug(string $slug): JsonResponse
    {
        try {
            $post = \App\Repositories\Blog\PostsRepository::getPostPerSlug($slug);

            return $this->success('Post recuperado com sucesso.', $post);
        } catch (NewsException $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }
}