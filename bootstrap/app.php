<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
  use App\Http\Middleware\Admin;
// use App\Http\Middleware\Authenticate;

// use App\Http\Middleware\EncryptCookies;
// use App\Http\Middleware\PreventRequestsDuringMaintenance;
// use App\Http\Middleware\RedirectIfAuthenticated;
// use App\Http\Middleware\TrimStrings;
// use App\Http\Middleware\TrustHosts;
// use App\Http\Middleware\TrustProxies;
// use App\Http\Middleware\VerifyCsrfToken;
 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => Admin::class
        ]);
     
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    }) 
    ->create();
