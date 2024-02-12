<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LuxeSearchController extends Controller
{
    use \App\Traits\ApiResponse;

    /**
     * Retorna todas as rotas publicas para o search do site.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request): JsonResponse
    {
        // Recupetando valor de search.
        $search = $request->has('q') ? $request->get('q') : null;

        // Recupetando todas as rotas do sistema.
        $routes = \Illuminate\Support\Facades\Route::getRoutes();
        $routesData = [];

        // Efetuando filtro.
        foreach ($routes as $route) {

            // Valida se a rota é da middleware web e não possui admin na uri.
            if (!str_contains($route->uri(), 'admin') && !str_contains($route->uri(), 'sanctum') && str_contains(implode(', ', $route->middleware()), 'web')) {
                $name = ucwords(str_replace('/', ' ', $route->uri())) === ' ' ? "Inicio" : null;
                // Salva apenas as rotas do tipo GET.
                $route->methods()[0] === 'GET' && !preg_match("/{/", $route->uri()) &&
                    $routesData[] = [
                        'method' => implode('|', $route->methods()),
                        'uri' => $route->uri(),
                        'location' => route($route->getName()),
                        'name' => $name ? $name : ucwords(
                            str_replace(
                                '-',
                                ' ',
                                str_replace('/', ' ', $route->uri())
                            )
                        ),
                        'middleware' => implode(', ', $route->middleware()),
                    ];
            }
        }

        // Efetua uma busca da rota com base no valor de search.
        if ($search) {
            $nroutes = [];
            foreach ($routesData as $r)
                if (str_contains($r['uri'], strtolower($search)))
                    array_push($nroutes, $r);

            return $this->success("Rotas recuperadas com sucesso.", $nroutes);

        }

        // Aqui você pode retornar as rotas como JSON, por exemplo
        return $this->success("Rotas recuperadas com sucesso.", $routesData);
    }
}