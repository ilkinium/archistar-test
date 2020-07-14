<?php


namespace App\Repositories\Interfaces;


use Illuminate\Support\Collection;

interface PropertyAnalyticRepositoryInterface
{
    /**
     * @param array $ids
     * @return Collection
     */
    public function getByIds(array $ids): Collection;

    /**
     * @param array $ids
     * @return array
     */
    public function getSummary(array $ids): array;
}
