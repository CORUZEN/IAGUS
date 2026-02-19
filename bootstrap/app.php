<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (TokenMismatchException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Sua sessao expirou. Recarregue a pagina e tente novamente.',
                ], 419);
            }

            return redirect()->route('login')
                ->with('error', 'Sua sessao expirou. Faca login novamente.');
        });

        // Fallback: algumas respostas 419 podem chegar como HttpException.
        $exceptions->respond(function (Response $response) {
            if ($response->getStatusCode() === 419 && !request()->expectsJson()) {
                return redirect()->route('login')
                    ->with('error', 'Sua sessao expirou. Faca login novamente.');
            }

            return $response;
        });
    })->create();

