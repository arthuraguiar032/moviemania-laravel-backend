<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->alias([
            'tmdb.validate' => \App\Http\Middleware\ValidateTmdbId::class,
        ]);
        
        $middleware->group('api', [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        
        $exceptions->shouldRenderJsonWhen(function ($e, $request) {
            return true;
        });
        
        $exceptions->render(function (\Illuminate\Validation\ValidationException $e, $request) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $e->errors(),
            ], 422);
        });

        $exceptions->render(function (\Symfony\Component\Routing\Exception\RouteNotFoundException $e, $request) {
            return response()->json([
                'message' => 'Não autenticado. Token ausente ou inválido (rota [login] não encontrada).',
            ], 401);
        });

        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            return response()->json([
                'message' => 'Não autenticado. Token ausente ou inválido.',
            ], 401);
        });

        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
            return response()->json([
                'message' => $e->getMessage() ?: 'Erro HTTP',
            ], $e->getStatusCode() ?: 500);
        });

        $exceptions->render(function (\Throwable $e, $request) {
            return response()->json([
                'message' => 'Erro interno do servidor',
                'exception' => get_class($e),
                'error' => $e->getMessage(),
            ], 500);
        });
    })->create();
