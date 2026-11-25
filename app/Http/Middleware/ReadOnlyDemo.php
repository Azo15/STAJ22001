<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReadOnlyDemo
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!config('demo.enabled')) {
            return $next($request);
        }

        abort_unless($request->isMethodSafe() && in_array($request->route()?->getName(), [
            'dashboard', 'books.index', 'books.show', 'genres.index', 'genres.show',
            'search.suggestions', 'search.results', 'privacy', 'terms',
        ], true), 403, 'Bu işlem demo sürümünde kapalıdır.');

        return $next($request);
    }
}
