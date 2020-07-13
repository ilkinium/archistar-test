<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PropertyRepositoryInterface;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * @var PropertyRepositoryInterface
     */
    private $propertyRepository;

    public function __construct(PropertyRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function index()
    {
        return $this->propertyRepository->getAnalytic(1);
    }
}
