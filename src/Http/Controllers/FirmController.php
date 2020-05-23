<?php

namespace WGT\Http\Controllers;

use Illuminate\Http\JsonResponse;
use WGT\Http\Controllers\Controller;
use WGT\Http\Controllers\Requests\StoreFirm;
use WGT\Http\Controllers\Requests\UpdateFirm;
use WGT\Services\FirmService;

class FirmController extends Controller
{
    /**
     * @param FirmService $service
     * @return JsonResponse
     */
    public function index(FirmService $service): JsonResponse
    {
        $firms = $service->paginate();

        return self::successfulResponse($firms);
    }

    /**
     * @param FirmService $service
     * @param int $firmId
     * @return JsonResponse
     */
    public function show(FirmService $service, int $firmId): JsonResponse
    {
        $firm = $service->find($firmId);

        return self::successfulResponse($firm);
    }

    /**
     * @param StoreFirm $request
     * @param FirmService $service
     * @return JsonResponse
     */
    public function store(StoreFirm $request, FirmService $service): JsonResponse
    {
        $firm = $service->createWithRelationship($request->all());

        return self::successfulResponse($firm, 201);
    }

    /**
     * @param UpdateFirm $request
     * @param FirmService $service
     * @param int $firmId
     * @return JsonResponse
     */
    public function update(UpdateFirm $request, FirmService $service, int $firmId): JsonResponse
    {
        $firm = $service->update($request->all(), $firmId);

        return self::successfulResponse($firm);
    }

    /**
     * @param FirmService $service
     * @param int $firmId
     * @return JsonResponse
     */
    public function destroy(FirmService $service, int $firmId): JsonResponse
    {
        $service->delete($firmId);

        return self::successfulResponse([]);
    }
}
