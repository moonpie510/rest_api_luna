<?php

namespace App\Services;

use App\Models\Building;
use Illuminate\Database\Eloquent\Collection;

class BuildingService
{
    public function getById(int $id, bool $throwException = false): ?Building
    {
        $building = Building::query()->find($id);

        if ($building === null && $throwException === true) {
            throw new \Exception('Здание не найдено');
        }

        return $building;
    }

    public function getByCoordinates(float $latMin, float $latMax, float $lngMin, float $lngMax): Collection
    {
        return Building::query()
            ->whereBetween('latitude', [$latMin, $latMax])
            ->whereBetween('longitude', [$lngMin, $lngMax])
            ->get();
    }
}
