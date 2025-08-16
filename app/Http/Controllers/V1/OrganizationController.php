<?php

namespace App\Http\Controllers\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CoordinateRequest;
use App\Services\ActivityService;
use App\Services\BuildingService;
use App\Services\OrganizationService;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller
{
    public function __construct(
        private readonly BuildingService     $buildingService,
        private readonly ActivityService     $activityService,
        private readonly OrganizationService $organizationService,
    )
    {}

    /** Список всех организаций находящихся в конкретном здании */
    public function showByBuilding(string $token, int $buildingId): JsonResponse
    {
        try {
            $building = $this->buildingService->getById(id: $buildingId, throwException: true);

            return ResponseHelper::success(data: ['organizations' => $building->organizations, 'building' => $building]);
        } catch (\Throwable $th) {
            return ResponseHelper::error(message: $th->getMessage());
        }
    }

    /** Список всех организаций, которые относятся к указанному виду деятельности */
    public function showByActivity(string $token, int $activityId): JsonResponse
    {
        try {
            $activity = $this->activityService->getById(id: $activityId, throwException: true);

            return ResponseHelper::success(data: ['organizations' => $activity->organizations, 'activity' => $activity]);
        } catch (\Throwable $th) {
            return ResponseHelper::error(message: $th->getMessage());
        }
    }

    /** Вывод информации об организации по её идентификатору */
    public function show(string $token, int $organizationId): JsonResponse
    {
        try {
            $organization = $this->organizationService->getById(id: $organizationId, throwException: true);
            $organization->loadMissing('activities', 'building', 'phones');

            return ResponseHelper::success(data: ['organization' => $organization]);
        } catch (\Throwable $th) {
            return ResponseHelper::error(message: $th->getMessage());
        }
    }

    /**
     * Искать организации по виду деятельности.
     *
     * Например, поиск по виду деятельности «Еда», которая находится на первом уровне дерева, и чтобы нашлись все организации,
     * которые относятся к видам деятельности, лежащим внутри. Т.е. в результатах поиска должны отобразиться организации
     * с видом деятельности Еда, Мясная продукция, Молочная продукция
     */
    public function showByActivityRecursive(string $token, int $activityId): JsonResponse
    {
        try {
            $activity = $this->activityService->getById(id: $activityId, throwException: true);
            $organizations = $this->organizationService->getByActivityRecursive($activity);
            $organizations->loadMissing('building', 'phones');

            return ResponseHelper::success(data: ['organizations' => $organizations, 'activity' => $activity]);
        } catch (\Throwable $th) {
            return ResponseHelper::error(message: $th->getMessage());
        }
    }

    /** Поиск организации по названию */
    public function searchOrganizations(string $token, string $text): JsonResponse
    {
        try {
            $organizations = $this->organizationService->search($text);
            $organizations->loadMissing('activities', 'building', 'phones');

            return ResponseHelper::success(data: ['organizations' => $organizations, 'text' => $text]);
        } catch (\Throwable $th) {
            return ResponseHelper::error(message: $th->getMessage());
        }
    }

    /** Список организаций, которые находятся в заданном радиусе/прямоугольной области относительно указанной точки на карте */
    public function showByCoordinates(string $token, CoordinateRequest $request): JsonResponse
    {
        try {
            $organizations = $this->organizationService->getByCoordinates(
                latMin: $request->lat_min,
                latMax: $request->lat_max,
                lngMin: $request->lng_min,
                lngMax: $request->lng_max
            );
            $organizations->loadMissing('activities', 'building', 'phones');

            return ResponseHelper::success(data: ['organizations' => $organizations]);
        } catch (\Throwable $th) {
            return ResponseHelper::error(message: $th->getMessage());
        }
    }
}
