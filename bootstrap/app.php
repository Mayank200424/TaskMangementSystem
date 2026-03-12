<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\ManagerAuth;
use App\Http\Middleware\EmployeeAuth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
           // 'role' => RoleMiddleware::class,
            'admin.auth'    => AdminAuth::class,
            'manager.auth'  => ManagerAuth::class,
            'employee.auth' => EmployeeAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
