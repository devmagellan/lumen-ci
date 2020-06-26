<?php

namespace WGT\Services;

use WGT\Repositories\FirmRepository;
use WGT\Services\AbstractService;
use WGT\Services\UserService;

class FirmService extends AbstractService
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param FirmRepository $repository
     * @param UserService $userService
     * @return void
     */
    public function __construct(FirmRepository $repository, UserService $userService)
    {
        $this->repository = $repository;
        $this->userService = $userService;
    }

    /**
     * @param int $firmId
     * @param int $userId
     * @param int $positionId
     * @return bool
     */
    public function attachEmployee(int $firmId, int $userId, int $positionId): bool
    {
        $this->userService->attachPosition($firmId, $userId, $positionId);
        $this->repository->attachEmployees($firmId, [$userId]);

        return true;
    }

    /**
     * @param int $firmId
     * @param int $userId
     * @param int $positionId
     * @return bool
     */
    public function detachEmployee(int $firmId, int $userId, int $positionId): bool
    {
        $this->userService->detachPosition($firmId, $userId, $positionId);

        if (!$this->userService->existsPositionsByFirmId($userId, $firmId)) {
            $this->repository->detachEmployees($firmId, [$userId]);
        }

        return true;
    }
}
