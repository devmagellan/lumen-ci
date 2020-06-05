<?php

namespace WGT\Repositories;

use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;
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
}
