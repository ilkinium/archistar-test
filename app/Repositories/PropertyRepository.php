<?php


namespace App\Repositories;


use App\AnalyticType;
use App\Property;
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
        // TODO: Implement create() method.
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
     * @return mixed
     */
    public function attachAnalytic(array $data, int $propertyId)
    {
        return $this->find($propertyId)
            ->analyticTypes()
            ->attach([$data['analytic_id'] => ['value' => $data['value']]]);
    }

    /**
     * @param array $data
     * @param int $propertyId
     * @return mixed
     */
    public function updateAttachedAnalytic(array $data, int $propertyId)
    {
        return $this->find($propertyId)
            ->analyticTypes()
            ->updateExistingPivot($data['analytic_id'], ['value' => $data['value']]);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function getQueryByCondition($key, $value)
    {
        return $this->property->where($key, $value);
    }

    /**
     * @param $requestData
     * @return mixed
     */
    public function getIdsByCondition($requestData)
    {
        $key = array_key_first($requestData);
        return $this->getQueryByCondition($key, $requestData[$key])->pluck('id')->toArray();
    }

}
