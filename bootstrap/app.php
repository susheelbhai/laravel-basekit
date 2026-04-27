<?php

use App\Http\Middleware\AddContentSecurityPolicy;
use App\Http\Middleware\AddHstsHeader;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(AddHstsHeader::class);
        $middleware->append(AddContentSecurityPolicy::class);

        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);

        Authenticate::redirectUsing(function ($request) {
            $path = explode('/', $request->getPathInfo());
            if (in_array('admin', $path)) {
                return route('admin.login');
            }
            if (in_array('partner', $path)) {
                return route('partner.login');
            }
            if (in_array('seller', $path)) {
                return route('seller.login');
            }
        });

        $middleware->validateCsrfTokens(except: [
            'callback_url',
            'webhook/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
