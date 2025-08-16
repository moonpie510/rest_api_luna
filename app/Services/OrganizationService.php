<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class OrganizationService
{
    public function getById(int $id, bool $throwException = false): ?Organization
    {
        $building = Organization::query()->where('id', $id)->first();

        if ($building === null && $throwException === true) {
            throw new \Exception('Организация не найдена');
        }

        return $building;
    }

    public function getByActivityRecursive(Activity $activity): Collection
    {
        $query = <<<SQL
            WITH RECURSIVE children AS (
                SELECT id FROM activities WHERE id = ?
                UNION ALL
                SELECT activities.id FROM activities
                JOIN children ON activities.parent_id = children.id
            )
            SELECT id FROM children
        SQL;

        $activitiesIds = array_column(DB::select($query, [$activity->id]), 'id');

        return Organization::query()->whereHas('activities', fn($q) => $q->whereIn('activities.id', $activitiesIds))->get();
    }

    public function search(string $text): Collection
    {
        return Organization::search($text)->get();
    }

    public function getByCoordinates(float $latMin, float $latMax, float $lngMin, float $lngMax): Collection
    {
        return Organization::query()
            ->whereHas('building', fn($q) => $q->whereBetween('latitude', [$latMin, $latMax])->whereBetween('longitude', [$lngMin, $lngMax]))
            ->get();
    }
}
