<?php

namespace App\Http\Middleware\Blog;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Protectedroutes
{
    use \App\Traits\ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach (config('blog.api.allowed_origins') as $origin) {
            if (!str_contains($request->header('Referer'), $origin)) {
                return $this->error('Acesso ao endereço de origin não autorizado.', \Illuminate\Http\Response::HTTP_UNAUTHORIZED);
            }
        }

        return $next($request);
    }
}