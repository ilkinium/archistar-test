<?php

declare(strict_types=1);

namespace App\Repositories;


use App\Models\Property;
use Illuminate\Support\Collection;

class PropertyRepository implements Interfaces\PropertyRepositoryInterface
{
    /**
     * @var Property
     */
    private $property;

    /**
     * PropertyRepository constructor.
     * @param Property $property
     */
    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    /**
     * @param int $id
     * @return Property
     */
    public function find(int $id): Property
    {
        return $this->property->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Property
     */
    public function create(array $data): Property
    {
        return $this->property->create($data);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getAnalytic(int $id): Collection
    {
        return $this->find($id)->analyticTypes()->get();
    }

    /**
     * @param array $data
     * @param int $propertyId
     * @return array|null
     */
    public function attachAnalytic(array $data, int $propertyId): ?array
    {
        return $this->find($propertyId)
            ->analyticTypes()
            ->syncWithoutDetaching([$data['analytic_id'] => ['value' => $data['value']]]);
    }

    /**
     * @param array $data
     * @param int $propertyId
     * @return int|null
     */
    public function updateAttachedAnalytic(array $data, int $propertyId): ?int
    {
        return $this->find($propertyId)
            ->analyticTypes()
            ->updateExistingPivot($data['analytic_id'], ['value' => $data['value']]);
    }

    /**
     * @param string $key
     * @param string $value
     * @return Collection
     */
    public function getQueryByCondition($key, $value): Collection
    {
        return $this->property->where($key, $value);
    }

    /**
     * @param array $requestData
     * @return array
     */
    public function getIdsByCondition(array $requestData): array
    {
        $key = array_key_first($requestData);

        return $this->getQueryByCondition($key, $requestData[$key])->pluck('id')->toArray();
    }

}
