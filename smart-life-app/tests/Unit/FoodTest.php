<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Food;

class FoodTest extends BaseTestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;

    public function test_create_food(): void
    {
        $response = $this->postJson('/api/foods', [
            'name' => 'Apple',
            'calories' => 95,
            'protein' => 0.5,
            'carbs' => 25,
            'fats' => 0.3,
        ]);
        $response->assertStatus(201)
                 ->assertJson([
                     'data' => [
                         'name' => 'Apple',
                         'calories' => 95,
                         'protein' => 0.5,
                         'carbs' => 25,
                         'fats' => 0.3,
                     ],
                 ]);
    }

    public function test_update_food(): void
    {
        $food = Food::create([
            'name' => 'Banana',
            'calories' => 105,
            'protein' => 1.3,
            'carbs' => 27,
            'fats' => 0.4,
        ]);

        $response = $this->putJson("/api/foods/{$food->id}", [
            'name' => 'Banana',
            'calories' => 110,
            'protein' => 1.5,
            'carbs' => 30,
            'fats' => 0.5,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'name' => 'Banana',
                         'calories' => 110,
                         'protein' => 1.5,
                         'carbs' => 30,
                         'fats' => 0.5,
                     ],
                 ]);
    }

    public function test_get_food(): void
    {
        $food = Food::create([
            'name' => 'Orange',
            'calories' => 62,
            'protein' => 1.2,
            'carbs' => 15,
            'fats' => 0.2,
        ]);

        $response = $this->getJson("/api/foods/{$food->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'name' => 'Orange',
                         'calories' => 62,
                         'protein' => 1.2,
                         'carbs' => 15,
                         'fats' => 0.2,
                     ],
                 ]);
    }

    public function test_get_food_list(): void
    {
        Food::create([
            'name' => 'Grapes',
            'calories' => 62,
            'protein' => 0.6,
            'carbs' => 16,
            'fats' => 0.3,
        ]);

        Food::create([
            'name' => 'Strawberry',
            'calories' => 4,
            'protein' => 0.1,
            'carbs' => 1,
            'fats' => 0.1,
        ]);

        $response = $this->getJson('/api/foods');

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }

    public function test_delete_food(): void
    {
        $food = Food::create([
            'name' => 'Pineapple',
            'calories' => 50,
            'protein' => 0.5,
            'carbs' => 13,
            'fats' => 0.1,
        ]);

        $response = $this->deleteJson("/api/foods/{$food->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('food', ['id' => $food->id]);
    }
} 
