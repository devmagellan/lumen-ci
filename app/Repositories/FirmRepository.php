<?php

namespace WGT\Repositories;

use Prettus\Repository\Events\RepositoryEntityCreated;
use WGT\Models\Firm;
use WGT\Repositories\AbstractRepository;

class FirmRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
        'description' => 'like',
        'website' => 'like',
    ];

    /**
     * @return string
     */
    public function model(): string
    {
        return Firm::class;
    }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $firm = $this->model->create($data);

        if (!empty($data['address'])) {
            $firm->address()->create($data['address']);
        }

        if (!empty($data['extra'])) {
            $firm->extra()->create($data['extra']);
        }

        event(new RepositoryEntityCreated($this, $firm));

        return $this->parserResult($firm);
    }

    /**
     * @param int $firmId
     * @param int $userId
     * @param array $data
     * @return bool
     */
    public function attachEmployee(int $firmId, int $userId, array $data): bool
    {
        $this->model->find($firmId)->users()->attach($userId, $data);

        return true;
    }

    /**
     * @param int $firmId
     * @param int $userId
     * @return bool
     */
    public function detachEmployee(int $firmId, int $userId): bool
    {
        $firm = $this->model->find($firmId)->users()->detach($userId);

        return true;
    }
}
