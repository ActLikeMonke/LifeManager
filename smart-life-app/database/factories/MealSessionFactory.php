<?php

namespace Database\Factories;

use App\Models\MealSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MealSession>
 */
class MealSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meal_id' => \App\Models\Meal::factory(),
            'eaten_at' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'notes' => fake()->sentence(),
        ];
    }
}
