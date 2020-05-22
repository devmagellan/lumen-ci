<?php

namespace WGT\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WGT\Http\Controllers\Controller;
use WGT\Http\Controllers\FormRequest\StoreFirm;

class FirmController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return self::successfulResponse();
    }

    /**
     * @param int $firmId
     * @return JsonResponse
     */
    public function show(int $firmId): JsonResponse
    {
        return self::successfulResponse();
    }

    /**
     * @param StoreFirm $request
     * @return JsonResponse
     */
    public function store(StoreFirm $request): JsonResponse
    {
        return self::successfulResponse();
    }

    /**
     * @param int $firmId
     * @return JsonResponse
     */
    public function update(int $firmId): JsonResponse
    {
        return self::successfulResponse();
    }

    /**
     * @param int $firmId
     * @return JsonResponse
     */
    public function destroy(int $firmId): JsonResponse
    {
        return self::successfulResponse();
    }
}
