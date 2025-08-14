<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    });

/*
|--------------------------------------------------------------------------
| Set Network-Specific Configuration
|--------------------------------------------------------------------------
|
| Detect the current network environment and set the appropriate URL.
| This ensures the application uses the correct URL based on whether
| it's running in the office or home network.
|
*/

$app = $app->create();

if (!$app->runningInConsole() && isset($app['request'])) {
    $app['request']->server->set('HTTP_HOST', parse_url(getNetworkUrl(), PHP_URL_HOST));
}

return $app;
