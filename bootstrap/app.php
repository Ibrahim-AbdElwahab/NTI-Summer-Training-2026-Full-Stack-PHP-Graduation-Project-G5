<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // استثناء مسارات معينة من الـ CSRF (لو إنت عاملها أو سيبها زي ما هي عندك)
        $middleware->validateCsrfTokens(except: [
            '/regist',
            '/login',
            '/logout',
        ]);

        // 👈 السطر ده هو المهم اللي بنضيفه عشان نسجل حارس الأدمن:
        $middleware->alias([
            'admin' => \App\Http\Middleware\CheckAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
