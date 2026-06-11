<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'calories' => fake()->numberBetween(50, 500),
            'protein' => fake()->randomFloat(2, 0, 50),
            'carbs' => fake()->randomFloat(2, 0, 100),
            'fats' => fake()->randomFloat(2, 0, 50),
        ];
    }
}
