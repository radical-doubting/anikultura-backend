<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait AsApiResponder
{
    protected function respondWithSuccess(
        string $message,
        mixed $data = null,
        int $statusCode = 200
    ): JsonResponse {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function respondWithError(
        string $message = null,
        int $statusCode = 500
    ): JsonResponse {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => null,
        ], $statusCode);
    }
}
