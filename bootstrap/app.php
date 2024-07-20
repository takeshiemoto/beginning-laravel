<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // LaravelがJSONを返すかHTMLを返すかはAcceptヘッダーによって判断される
        // shouldRenderJsonWhenを利用して判定条件を変更することができる
        // この設定ではAcceptヘッダーの有無に問わず/apiへのアクセスはすべてJSONを返す
        $exceptions->shouldRenderJsonWhen(function (Request $request) {
            if ($request->is('api/*')) {
                return true;
            }
            return $request->expectsJson();
        });
    })->create();
