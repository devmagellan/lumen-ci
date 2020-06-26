<?php

namespace WGT\Services;

use Exception;
use WGT\Repositories\UserRepository;
use WGT\Services\AbstractService;
use WGT\Services\PositionService;

class UserService extends AbstractService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var PositionService
     */
    protected $positionService;

    /**
     * @return void
     */
    public function __construct(UserRepository $repository, PositionService $positionService)
    {
        $this->repository = $repository;
        $this->positionService = $positionService;
    }

    /**
     * @param int $firmId
     * @param int $userId
     * @param int $positionId
     * @return bool
     */
    public function attachPosition(int $firmId, int $userId, int $positionId): bool
    {
        $position = $this->positionService->find($positionId);
        if ($position->firm_id != $firmId) {
            throw new Exception(__('messages.attach_position_firm_invalid'));
        }

        $this->repository->attachPositions($userId, [$positionId]);

        return true;
    }

    /**
     * @param int $firmId
     * @param int $userId
     * @param int $positionId
     * @return bool
     */
    public function detachPosition(int $firmId, int $userId, int $positionId): bool
    {
        $position = $this->positionService->find($positionId);
        if ($position->firm_id != $firmId) {
            throw new Exception(__('messages.detach_position_firm_invalid'));
        }

        $this->repository->detachPositions($userId, [$positionId]);

        return true;
    }
}
