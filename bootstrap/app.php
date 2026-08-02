<?php

use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            ForceJsonResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Uniform JSON error envelope for the API (docs/openapi.yaml).
        $envelope = function (string $code, string $message, int $status, ?array $details = null) {
            return response()->json([
                'error' => array_filter([
                    'code' => $code,
                    'message' => $message,
                    'details' => $details,
                ], fn ($v) => $v !== null),
            ], $status);
        };

        $exceptions->render(function (ValidationException $e, Request $request) use ($envelope) {
            if ($request->is('api/*')) {
                return $envelope('validation_failed', 'The given data was invalid.', 422, $e->errors());
            }
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) use ($envelope) {
            if ($request->is('api/*')) {
                return $envelope('unauthenticated', 'Authentication required.', 401);
            }
        });

        $exceptions->render(function (AuthorizationException $e, Request $request) use ($envelope) {
            if ($request->is('api/*')) {
                return $envelope('forbidden', 'You are not allowed to perform this action.', 403);
            }
        });

        $exceptions->render(function (ThrottleRequestsException $e, Request $request) use ($envelope) {
            if ($request->is('api/*')) {
                return $envelope('rate_limited', 'Too many requests. Please slow down.', 429)
                    ->withHeaders($e->getHeaders());
            }
        });

        $exceptions->render(function (ModelNotFoundException|NotFoundHttpException $e, Request $request) use ($envelope) {
            if ($request->is('api/*')) {
                return $envelope('not_found', 'Resource not found.', 404);
            }
        });

        $exceptions->render(function (HttpException $e, Request $request) use ($envelope) {
            if ($request->is('api/*')) {
                return $envelope('http_error', $e->getMessage() ?: 'Request failed.', $e->getStatusCode());
            }
        });

        $exceptions->render(function (Throwable $e, Request $request) use ($envelope) {
            if ($request->is('api/*') && ! config('app.debug')) {
                report($e);

                return $envelope('server_error', 'Something went wrong on our side.', 500);
            }
        });
    })->create();
