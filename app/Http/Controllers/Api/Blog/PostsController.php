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
        $order = 'news_post_title';

        // Aplica filtro por string se houver o parametro search.
        if ($request->has('search')) {
            // Recuperando valor de 'search'.
            $search = $request->get('search');

            // Inserindo porcentagem se não houver.
            if (strpos($search, '%') === false) {
                // Aplicando porcentagem.
                $search = '%' . $search . '%';
            }

            // Cria filtro WHERE.
            $query_string = "WHERE CONCAT_WS(
                news_post_title,news_post_content,news_post_slug,news_post_summary,news_post_tags,news_post_views,news_post_status,news_post_active_comments
                ) LIKE {$search}
            ";
        }

        // Recuperando registros.
        $posts = \App\Repositories\Blog\PostsRepository::posts($query_string);

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