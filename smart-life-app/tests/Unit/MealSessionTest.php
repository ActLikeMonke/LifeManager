<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\MealSession;

class MealSessionTest extends BaseTestCase
{

    use RefreshDatabase;

    public function test_get_meal_sessions() : void 
    {
        MealSession::factory()->count(5)->create();
        $response = $this->getJson('/api/meal-sessions');
        $response->assertStatus(200);
    }
    public function test_get_single_meal_session() : void 
    {
        $mealSession = MealSession::factory()->create();
        $response = $this->getJson("/api/meal-sessions/{$mealSession->id}");
        $response->assertStatus(200);
    }

    public function test_create_meal_session() : void 
    {
        $mealSessionData = [
            'meal_id' => \App\Models\Meal::factory()->create()->id,
            'notes' => 'Test meal session',
        ];

        $response = $this->postJson('/api/meal-sessions', $mealSessionData);
        $response->assertStatus(201);
    }
    public function test_update_meal_session() : void 
    {
        $mealSession = MealSession::factory()->create();
        $mealSession->notes = 'Updated notes';
        $response = $this->putJson("/api/meal-sessions/{$mealSession->id}", $mealSession->getAttributes());
        $response->assertStatus(200);
    }
    public function test_delete_meal_session() : void 
    {
        $mealSession = MealSession::factory()->create();
        $response = $this->deleteJson("/api/meal-sessions/{$mealSession->id}");
        $response->assertStatus(204);
    }


}
