<?php

namespace App\Http\Controllers\Admin\Services;

use App\Exceptions\NewsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\NewsUpdateRequest;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use \App\Traits\ApiResponse;

    /**
     * Guarda o modelo de Noticias/Posts.
     *
     * @var News
     */
    protected \App\Models\News $news;

    /**
     * Construtor de inicialização.
     */
    public function __construct()
    {
        $this->news = new \App\Models\News();
    }

    /**
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Recupetando parametros da requisição e valor se houver.
            $search = $request->has('q') ? $request->get('q') : null;
            $perPage = $request->has('per_page') ? $request->get('per_page') : 10;

            // Carregando registros.
            $news = \App\Repositories\NewsRepository::news($search, $perPage);

            return $this->success('Notícias recuperadas com sucesso.', $news);
        } catch (NewsException $error) {
            return $this->success($error->getMessage(), [], \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Cria um novo Post.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param NewsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewsRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Recuperando categoria.
            $category = \App\Models\Category::where('id', $request->cod_category_fk)->first();

            // Valida se a categoria existe.
            if (!$category) {
                throw new NewsException('Categoria informada não existe.');
            }

            // Recuperando dados da requisição.
            $requestData = $request->only([
                "news_post_title",
                "cod_category_fk",
                "news_post_content",
                "news_post_slug",
                "news_post_summary",
                "news_post_tags",
            ]);

            // Inserindo ID de usuário.
            $requestData['cod_user_fk'] = auth()->user()->id;

            // Validando HTML.
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            $requestData['news_post_content'] = $purifier->purify($requestData['news_post_content']);

            // Criando POST.
            $post = $this->news->create($requestData);

            // Validando criação.
            if ($post) {
                return $this->success('Post criado com sucesso.');
            }

            throw new NewsException('Post não pode ser criado. Por favor, tente novamente.');
        } catch (NewsException $error) {
            return $this->success($error->getMessage(), [], \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Retorna um registro para edição.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $newsId
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $newsId): \Illuminate\Http\JsonResponse
    {
        try {
            // Recuperando post para edição.
            $news = \App\Repositories\NewsRepository::findForEdit($newsId);

            return $this->success('Post recuperado com sucesso.', $news);
        } catch (NewsException $error) {
            return $this->success($error->getMessage(), [], \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Atualiza um post.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param NewsRequest $request
     * @param string $newsId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NewsUpdateRequest $request, string $newsId): \Illuminate\Http\JsonResponse
    {
        try {
            // Recuperando post
            $news = \App\Repositories\NewsRepository::findForEdit($newsId);

            // Validando se existe o post.
            !$news && throw new NewsException('Notícia não localizada.');

            // Recuperando categoria.
            $category = \App\Models\Category::where('id', $request->cod_category_fk)->first();

            // Valida se a categoria existe.
            !$category && throw new NewsException('Categoria informada não existe.');

            // Recuperando dados da requisição.
            $requestData = $request->only([
                "news_post_title",
                "cod_category_fk",
                "news_post_content",
                "news_post_slug",
                "news_post_summary",
                "news_post_tags",
            ]);

            // Validando HTML.
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            $requestData['news_post_content'] = $purifier->purify($requestData['news_post_content']);

            // Criando POST.
            $post = $this->news->where('id', $newsId)->update($requestData);

            // Validando criação.
            if ($post) {
                return $this->success('Notícia atualizado com sucesso.');
            }

            throw new NewsException('Notícia não pode ser atualizado. Por favor, tente novamente.');
        } catch (NewsException $error) {
            return $this->success($error->getMessage(), [], \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Exclui um post.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $newsId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $newsId): \Illuminate\Http\JsonResponse
    {
        try {
            // Recuperando post para edição.
            \App\Repositories\NewsRepository::destroy($newsId);

            return $this->success('Post excluído com sucesso.', []);
        } catch (NewsException $error) {
            return $this->success($error->getMessage(), [], \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }
}