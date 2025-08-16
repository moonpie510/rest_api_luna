<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Organization;
use App\Models\OrganizationActivity;
use Illuminate\Database\Eloquent\Factories\Factory;


class OrganizationActivityFactory extends Factory
{
    protected $model = OrganizationActivity::class;

    public function definition(): array
    {
        return [
            'organization_id' => Organization::query()->inRandomOrder()->value('id'),
            'activity_id' => Activity::query()->inRandomOrder()->value('id'),
        ];
    }
}
