<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CategoryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Guarda o modelo de Categorias.
     *
     * @var Category
     */
    protected Category $category;

    /**
     * Construtor de Inicialização.
     */
    public function __construct()
    {
        $this->category = new Category();
    }

    /**
     * Lista todas as categorias.
     * 
     * @author Luan Santos <lvluansantos@gmail.com>     *
     * @return void
     */
    public function index()
    {

        $categories = $this->category->get();

        return view('pages.admin.news.category.index')->with([
            'title'         => 'Categorias',
            'categories'    => $categories,
        ]);
    }

    /**
     * Recupera as categorias.
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories(): \Illuminate\Http\JsonResponse
    {
        $categories = $this->category->get();

        return response()->json($categories);
    }

    /**
     * Exibe o display de criação de categoria.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return void
     */
    public function create()
    {

        return view('pages.admin.news.category.create')->with([
            'title'         => 'Nova Categoria',
        ]);
    }

    /**
     * Cria uma nova categoria.
     *
     * @param CategoryRequest $request
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return void
     */
    public function store(CategoryRequest $request)
    {
        try {
            // Recuperando os valores da requisição.
            $requestData = $request->only(['description', 'category']);

            // Criando categoria.
            $category = $this->category->create($requestData);

            // Validando criação.
            if ($category) {
                return redirect()->route('admin.news.categories.index')->with([
                    'status'        => true,
                    'message'       => "Categoria criada com sucesso.",
                    'type'          => 'Success',
                ]);
            }

            throw new CategoryException('Não foi possível criar a categoria. Por favor, tente novamente.');
        } catch (CategoryException $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ])->withInput();
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ])->withInput();
        }
    }

    /**
     * Exibe display de edição de categoria.
     *
     * @param string $categoryId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return void
     */
    public function edit(string $categoryId)
    {
        try {
            // Recupera a categoria para edição.
            $category = $this->category->where('id', $categoryId)->first();

            if (!$category) {
                throw new CategoryException('Categoria não encontrada para edição.');
            }

            return view('pages.admin.news.category.edit')->with([
                'title'         => 'Editar Categoria',
                'category'      => $category,
            ]);
        } catch (CategoryException $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ])->withInput();
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ])->withInput();
        }
    }

    /**
     * Atualiza uma categoria.
     *
     * @param CategoryUpdateRequest $request
     * @param string $categoryId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return void
     */
    public function update(CategoryUpdateRequest $request, string $categoryId)
    {
        try {
            // Recupera a categoria para edição.
            $category = $this->category->where('id', $categoryId)->first();

            // Valida se a categoria existe.
            if (!$category) {
                throw new CategoryException('Categoria não encontrada para edição.');
            }

            // Recuperando os valores da requisição.
            $requestData = $request->only(['description', 'category']);

            // Validando existencia de um slug.
            $slug = $this->category->where('category', $requestData['category'])->where('id', '!=', $categoryId)->first();

            // Validando se existe.
            if ($slug) {
                throw new CategoryException('Já existe uma categoria com esse nome nome.');
            }

            // Criando categoria.
            $category = $this->category->where('id', $categoryId)->update($requestData);

            // Validando criação.
            if ($category) {
                return redirect()->route('admin.news.categories.index')->with([
                    'status'        => true,
                    'message'       => "Categoria atualizada com sucesso.",
                    'type'          => 'Success',
                ]);
            }

            throw new CategoryException('Não foi possível criar a categoria. Por favor, tente novamente.');
        } catch (CategoryException $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ])->withInput();
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ])->withInput();
        }
    }
}