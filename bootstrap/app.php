<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserHasRole;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\ServerRequestInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->append(EnsureUserHasRole::class);
        $middleware->alias([
            'role' => EnsureUserHasRole::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Uygulama özel hata işleyicilerini burada tanımlayabilirsiniz
    })->create();
