<?php

namespace WGT\Repositories;

use WGT\Models\Firm;
use WGT\Repositories\AbstractRepository;

class FirmRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Firm::class;
    }

    /**
     * @param array $data
     * @return Firm
     */
    public function create(array $data): Firm
    {
        $firm = $this->model->create($data);

        if (!empty($data['address'])) {
            $firm->address()->create($data['address']);
        }

        if (!empty($data['extra'])) {
            $firm->extra()->create($data['extra']);
        }

        return $firm;
    }

    /**
     * @param int $firmId
     * @param int $userId
     * @param array $data
     * @return bool
     */
    public function attachEmployee(int $firmId, int $userId, int $positionId): bool
    {
        $this->model->find($firmId)->employees()->attach($userId, ['position_id' => $positionId]);

        return true;
    }

    /**
     * @param int $firmId
     * @param int $userId
     * @param int $positionId
     * @return bool
     */
    public function detachEmployees(int $firmId, int $userId, int $positionId): bool
    {
        return $this->model->find($firmId)->employees()
            ->wherePivot('position_id', $positionId)->detach($userId);
    }
}
