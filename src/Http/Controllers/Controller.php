<?php

namespace WGT\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param array $response
     * @param int $code
     * @return JsonResponse
     */
    protected static function successfulResponse(array $response = [], int $code = 200): JsonResponse
    {
        return self::response('success', $code, $response);
    }

    /**
     * @param array $response
     * @param int $code
     * @return JsonResponse
     */
    protected static function errorResponse(array $response = [], int $code = 500): JsonResponse
    {
        return self::response('error', $code, $response);
    }

    /**
     * @param array $response
     * @param int $code
     * @return JsonResponse
     */
    protected static function response(string $status, int $code = 200, array $data = []): JsonResponse
    {
        $response = ['status' => $status, 'code' => $code];
        $response = array_merge($response, $data);

        return response()->json($response, $code);
    }
}
