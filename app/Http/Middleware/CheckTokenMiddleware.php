<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Миддлвар для проверки наличия токена.
 */
class CheckTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (empty($request->token) || $request->token !== config('app.api_key')) {
            return ResponseHelper::error(message: 'Не найден или неверный API ключ', code: 401);
        }

        return $next($request);
    }
}
