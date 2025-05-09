<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware global (opsional)
        // $middleware->append(\App\Http\Middleware\ExampleGlobalMiddleware::class);

        // Route middleware (ini yang kamu butuhkan)
        $middleware->alias([
            'admin' => \App\Middleware\AdminMiddleware::class,
            'sekretaris' => \App\Middleware\SekretarisMiddleware::class,
            'kepala' => \App\Middleware\KepalaMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
