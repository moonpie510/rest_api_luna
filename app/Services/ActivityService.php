<?php

namespace App\Services;

use App\Models\Activity;

class ActivityService
{
    public function getById(int $id, bool $throwException = false): ?Activity
    {
        $building = Activity::query()->find($id);

        if ($building === null && $throwException === true) {
            throw new \Exception('Деятельность не найдена');
        }

        return $building;
    }
}
