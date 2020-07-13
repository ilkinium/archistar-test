<?php


namespace App\Repositories\Interfaces;


use App\Property;
use Illuminate\Support\Collection;

interface PropertyRepositoryInterface
{
    public function find(int $id): Property;

    public function create(array $data): Property;

    public function getAnalytic(int $id): Collection;
}
