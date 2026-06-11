<?php

namespace Database\Factories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Meal>
 */
class MealFactory extends Factory
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
        ];
    }

        /**
        * Configure the model factory.
        *
        * @return $this
        */
        public function configure(): static
        {
            return $this->afterCreating(function (Meal $meal) {
                // Attach random foods to the meal with random quantities
                $foodIds = \App\Models\Food::inRandomOrder()->take(rand(1, 5))->pluck('id');
                foreach ($foodIds as $foodId) {
                    $meal->foods()->attach($foodId, ['quantity' => rand(50, 500)]);
                }
            });
        }

}
