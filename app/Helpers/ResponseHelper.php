<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

/**
 * Хелпер для стандартизации ответов API.
 */
class ResponseHelper
{
    /**
     * Возвращает json успешного ответа.
     */
    public static function success(array $data = [], string $message = 'Запрос прошел успешно', int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * Возвращает json об ошибках.
     */
    public static function error(array $errors = [], string $message = 'Возникла ошибка', int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'code' => $code,
            'message' => $message,
            'errors' => $errors
        ]);
    }
}
