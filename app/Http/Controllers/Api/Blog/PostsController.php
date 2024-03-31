<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        // Variavel string.
        $query_string = "";
        $paginate = 10;
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
        // dd($posts->paginate());
        return response()->json($posts);
    }
}