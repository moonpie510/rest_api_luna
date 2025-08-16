<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;


class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'parent_id' => null,
        ];
    }

    public function configure(): ActivityFactory
    {
        return $this->afterCreating(function (Activity $activity) {
            if (Activity::query()->count() > 1 && fake()->boolean(70)) {
                $activity->update([
                    'parent_id' => Activity::query()->where('id', '!=', $activity->id)->value('id')
                ]);
            }
        });
    }
}
