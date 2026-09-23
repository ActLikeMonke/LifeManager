<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\Set;
use App\Models\WorkoutSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Set>
 */
class SetFactory extends Factory
{
    protected $model = Set::class;

    public function definition(): array
    {
        return [
            'workout_session_id' => WorkoutSession::factory(),
            'exercise_id' => Exercise::factory(),
            'weight' => fake()->randomFloat(2, 0, 200),
            'reps' => fake()->numberBetween(1, 20),
            'rpe' => fake()->optional()->numberBetween(1, 10),
            'pr' => fake()->optional()->randomFloat(2, 0, 200),
            'is_warmup' => fake()->boolean(),
        ];
    }
}