<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Meal;
use App\Models\Food;

class MealTest extends BaseTestCase
{
    use RefreshDatabase;

    public function test_meal_creation(): void
    {
        $foods = Food::factory()->count(2)->create();
        $response = $this->postJson('/api/meals', [
            'name' => 'Test Meal',
            'foods' => [
                ['id' => $foods[0]->id, 'quantity' => 100],
                ['id' => $foods[1]->id, 'quantity' => 200],
            ],
        ])->assertStatus(201);

        $response->assertJson([
            'data' => [
                'meal_name' => 'Test Meal',
                'foods' => [
                    ['id' => $foods[0]->id, 'quantity' => 100],
                    ['id' => $foods[1]->id, 'quantity' => 200],
                ],
            ],
        ]);
    }

    public function test_get_meal(): void
    {
        $meal = Meal::factory()->create();
        $response = $this->getJson("/api/meals/{$meal->id}")->assertStatus(200);
        $response->assertJson([
            'data' => [
                'meal_name' => $meal->name,
                'foods' => [],
            ],
        ]);
    }

    public function test_get_meals(): void
    {

        Meal::factory()->count(2)->create();
        $response = $this->getJson('/api/meals')->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'meal_name',
                    'foods' => [
                        '*' => [
                            'id',
                            'name',
                            'quantity',
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function test_update_meal(): void
    {
        $meal = Meal::factory()->create();
        $food = Food::factory()->count(2)->create();

        $response = $this->putJson("/api/meals/{$meal->id}", [
            'name' => 'Updated Meal',
            'foods' => [
                ['id' => $food[0]->id, 'quantity' => 150],
                ['id' => $food[1]->id, 'quantity' => 250],
            ],
        ])->assertStatus(200);

        $response->assertJson([
            'data' => [
                'meal_name' => 'Updated Meal',
                'foods' => [
                    ['id' => $food[0]->id, 'quantity' => 150],
                    ['id' => $food[1]->id, 'quantity' => 250],
                ],
            ],
        ]);
    }

    public function test_delete_meal(): void
    {
        $meal = Meal::factory()->create();
        $this->deleteJson("/api/meals/{$meal->id}")->assertStatus(204);
        $this->assertDatabaseMissing('meals', ['id' => $meal->id]);
    }

}
