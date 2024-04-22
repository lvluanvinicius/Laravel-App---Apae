<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    use \App\Traits\ApiResponse;

    /**
     * Guarda o modelo de categoria.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @var \App\Models\Category
     */
    protected \App\Models\Category $category;

    /**
     * Guarda o modelo de notícias.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @var \App\Models\News
     */
    protected \App\Models\News $news;

    /**
     * Inicializa o controlador.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param \App\Models\Category $category
     */
    public function __construct(
        \App\Models\Category $category,
        \App\Models\News $news
    ) {
        $this->category = $category;
        $this->news = $news;
    }

    /**
     * Efetua a exclusão de uma categoria.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $newsId
     * @return void
     */
    public function destroy(string $newsId): JsonResponse
    {
        try {
            // Recuperando notícia.
            $category = $this->category->where('id', $newsId)->first();

            // Validando se o registro existe.
            if (!$category) {
                throw new \App\Exceptions\NewsException("Categoria não encontrada ou ja foi excluída.");
            }

            // Validando se a categoria possui notícias.
            if ($this->news->where('cod_category_fk', $category->id)->count()) {
                throw new \App\Exceptions\NewsException("Categoria não pode ser excluída, pois possui notícias.");
            }

            // Excluindo notícia.
            if (!$category->delete()) {
                throw new \App\Exceptions\NewsException("Categoria não pode ser excluída, tente novamente.");
            }

            return $this->success('Categoria excluída com sucesso.');

        } catch (\App\Exceptions\NewsException $e) {
            return $this->success($e->getMessage(), [], \Illuminate\Http\Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }
}