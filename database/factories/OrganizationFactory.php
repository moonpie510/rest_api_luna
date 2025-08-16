<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;


class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition(): array
    {
        return [
            'title' => implode(' ', fake()->words()),
            'building_id' => Building::query()->inRandomOrder()->value('id'),
        ];
    }
}
