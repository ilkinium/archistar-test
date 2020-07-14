<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignAnalyticToPropertyRequest;
use App\Http\Requests\CreatePropertyRequest;
use App\Repositories\Interfaces\PropertyAnalyticRepositoryInterface;
use App\Repositories\Interfaces\PropertyRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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


    /**
     * @param Request $request
     * @param PropertyAnalyticRepositoryInterface $propertyAnalyticRepository
     * @return JsonResponse
     */
    public function index(
        Request $request,
        PropertyAnalyticRepositoryInterface $propertyAnalyticRepository
    ): JsonResponse {
        $ids = $this->propertyRepository->getIdsByCondition($request->all());

        return response()->json($propertyAnalyticRepository->getSummary($ids), Response::HTTP_OK);
    }

    /**
     * @param CreatePropertyRequest $request
     * @return JsonResponse|object
     */
    public function create(CreatePropertyRequest $request): JsonResponse
    {
        return response()->json($this->propertyRepository->create($request->all()), Response::HTTP_OK);
    }

    /**
     * @param $id
     * @param AssignAnalyticToPropertyRequest $request
     * @return JsonResponse
     */
    public function assignAnalytic(int $id, AssignAnalyticToPropertyRequest $request): JsonResponse
    {
        try {
            $this->propertyRepository->attachAnalytic($request->all(), $id);

            return response()->json('Success!', Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param int $id
     * @param AssignAnalyticToPropertyRequest $request
     * @return JsonResponse
     */
    public function update(int $id, AssignAnalyticToPropertyRequest $request): JsonResponse
    {
        try {
            $this->propertyRepository->updateAttachedAnalytic($request->all(), $id);

            return response()->json('Success!', Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->propertyRepository->getAnalytic($id), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
