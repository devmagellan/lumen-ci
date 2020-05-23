<?php

namespace WGT\Services;

use WGT\Repositories\FirmAddressRepository;
use WGT\Repositories\FirmExtraRepository;
use WGT\Repositories\FirmRepository;
use WGT\Services\AbstractService;

class FirmService extends AbstractService
{
    /**
     * @var FirmRepository
     */
    protected $repository;

    /**
     * @var FirmAddressRepository
     */
    protected $addressRepository;

    /**
     * @var FirmExtraRepository
     */
    protected $extraRepository;

    /**
     * @return void
     */
    public function __construct(
        FirmRepository $repository,
        FirmAddressRepository $addressRepository,
        FirmExtraRepository $extraRepository
    ) {
        $this->repository = $repository;
        $this->addressRepository = $addressRepository;
        $this->extraRepository = $repository;
    }

    /**
     * @param int $request
     * @return array
     */
    public function createWithRelationship(array $request): array
    {
        $firm = $this->repository->create($request)['data'];

        $request['address'] = $request['address'] ?? false ?: [];
        if ($address = $this->createAddress($request['address'] ?? [], $firm['id'])) {
            $firm['address'] = $address;
        }

        $request['extra'] = $request['extra'] ?? false ?: [];
        if ($extra = $this->createExtra($request['extra'] ?? [], $firm['id'])) {
            $firm['extra'] = $extra;
        }

        return ['data' => $firm];
    }

    /**
     * @param array $address
     * @param int $firmId
     * @return array
     */
    public function createAddress(array $address, int $firmId): array
    {
        if (empty($address) || empty($firmId)) {
            return [];
        }

        $address['firm_id'] = $firmId;

        return $this->addressRepository->create($address)['data'];
    }

    /**
     * @param array $extra
     * @param int $firmId
     * @return array
     */
    public function createExtra(array $extra, int $firmId): array
    {
        if (empty($extra) || empty($firmId)) {
            return [];
        }

        $extra['firm_id'] = $firmId;

        return $this->extraRepository->create($extra)['data'];
    }
}
