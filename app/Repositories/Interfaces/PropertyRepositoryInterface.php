<?php


namespace App\Repositories\Interfaces;


use App\Models\Property;
use Illuminate\Support\Collection;

interface PropertyRepositoryInterface
{
    /**
     * @param int $id
     * @return Property
     */
    public function find(int $id): Property;

    /**
     * @param array $data
     * @return Property
     */
    public function create(array $data): Property;

    /**
     * @param int $id
     * @return Collection
     */
    public function getAnalytic(int $id): Collection;

    /**
     * @param array $data
     * @param int $propertyId
     * @return array|null
     */
    public function attachAnalytic(array $data, int $propertyId): ?array;

    /**
     * @param array $data
     * @param int $propertyId
     * @return int|null
     */
    public function updateAttachedAnalytic(array $data, int $propertyId): ?int;

    /**
     * @param string $key
     * @param string $value
     * @return Collection
     */
    public function getQueryByCondition(string $key, string $value): Collection;

    /**
     * @param array $requestData
     * @return array
     */
    public function getIdsByCondition(array $requestData): array;
}
