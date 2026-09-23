<?php

namespace Database\Factories;

use App\Models\WorkoutSession;
use App\Models\WorkoutLayout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkoutSession>
 */
class WorkoutSessionFactory extends Factory
{
    protected $model = WorkoutSession::class;

    public function definition(): array
    {
        $startedAt = fake()->dateTimeBetween('-1 month', 'now');

        return [
            'workout_layout_id' => WorkoutLayout::factory(),
            'started_at' => $startedAt,
            'finished_at' => fake()->optional()->dateTimeBetween($startedAt, 'now'),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}