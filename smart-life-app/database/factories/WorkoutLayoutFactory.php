<?php

namespace Database\Factories;

use App\Models\WorkoutLayout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkoutLayout>
 */
class WorkoutLayoutFactory extends Factory
{
    protected $model = WorkoutLayout::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
        ];
    }
}