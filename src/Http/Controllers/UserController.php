<?php

namespace WGT\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use WGT\Http\Controllers\Controller;
use WGT\Http\Controllers\Requests\UpdateUser;
use WGT\Services\UserService;

class UserController extends Controller
{
    /**
     * @param UserService $service
     * @return JsonResponse
     */
    public function show(UserService $service): JsonResponse
    {
        $firm = $service->find(Auth::user()->id);

        return self::successfulResponse($firm);
    }

    /**
     * @param UpdateUser $request
     * @param UserService $service
     * @return JsonResponse
     */
    public function update(UpdateUser $request, UserService $service): JsonResponse
    {
        $firm = $service->update($request->all(), Auth::user()->id);

        return self::successfulResponse($firm);
    }
}
