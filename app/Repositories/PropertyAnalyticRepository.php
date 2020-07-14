<?php


namespace App\Repositories;


use App\Models\PropertyAnalytic;
use Illuminate\Support\Collection;

class PropertyAnalyticRepository implements Interfaces\PropertyAnalyticRepositoryInterface
{
    /**
     * @var PropertyAnalytic
     */
    private $propertyAnalytic;

    /**
     * PropertyAnalyticRepository constructor.
     * @param PropertyAnalytic $propertyAnalytic
     */
    public function __construct(PropertyAnalytic $propertyAnalytic)
    {
        $this->propertyAnalytic = $propertyAnalytic;
    }

    /**
     * @inheritDoc
     */
    public function getByIds(array $ids): Collection
    {
        return $this->propertyAnalytic->whereIn('id', $ids)->get();
    }

    /**
     * @inheritDoc
     */
    public function getSummary(array $ids): array
    {
        $data = $this->getByIds($ids);
        if ($data->count() == 0) {
            return [];
        }
        $notNullPercentage = ($data->whereNotNull('value')->count() * 100) / $data->count();
        return [
            'min' => $data->min()->value,
            'max' => $data->max()->value,
            'median' => $data->sum('value') / $data->count(),
            'notNullPercentage' => $notNullPercentage,
            'nullPercentage' => 100 - $notNullPercentage
        ];
    }
}
