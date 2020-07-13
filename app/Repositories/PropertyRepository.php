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
}
