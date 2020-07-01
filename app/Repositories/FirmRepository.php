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
     * @param array $users
     * @return bool
     */
    public function attachEmployees(int $firmId, array $users): bool
    {
        $this->model->find($firmId)->employees()->syncWithoutDetaching($users);

        return true;
    }

    /**
     * @param int $firmId
     * @param array $users
     * @return bool
     */
    public function detachEmployees(int $firmId, array $users): bool
    {
        return $this->model->find($firmId)->employees()->detach($users);
    }
}
