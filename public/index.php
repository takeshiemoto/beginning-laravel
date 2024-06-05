<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// https://laravel.com/docs/11.x/lifecycle#service-providers

// Composerのオートローダーを登録する
require __DIR__.'/../vendor/autoload.php';

// Laravelをブートストラップしてリクエストを処理する
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
