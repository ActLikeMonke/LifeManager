<?php

namespace Tests\Unit;

use App\Models\Set;
use App\Models\Exercise;
use App\Models\WorkoutSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SetTest extends TestCase
{
    use RefreshDatabase;

    public function test_set_crud_endpoints(): void
    {
        $set = Set::factory()->create();

        $this->getJson('/api/sets')->assertOk();
        $this->getJson("/api/sets/{$set->id}")->assertOk();
        $this->postJson('/api/sets', [
            'workout_session_id' => WorkoutSession::factory()->create()->id,
            'exercise_id' => Exercise::factory()->create()->id,
            'weight' => 42.5,
            'reps' => 10,
            'rpe' => 8,
            'pr' => 45,
            'is_warmup' => false,
        ])->assertCreated();
        $this->patchJson("/api/sets/{$set->id}", [
            'workout_session_id' => $set->workout_session_id,
            'exercise_id' => $set->exercise_id,
            'weight' => 50,
            'reps' => 8,
            'rpe' => 9,
            'pr' => 50,
            'is_warmup' => false,
        ])->assertOk();
        $this->putJson("/api/sets/{$set->id}", [
            'workout_session_id' => $set->workout_session_id,
            'exercise_id' => $set->exercise_id,
            'weight' => 47.5,
            'reps' => 10,
            'rpe' => 8,
            'is_warmup' => true,
        ])->assertOk();
        $this->deleteJson("/api/sets/{$set->id}")->assertNoContent();
    }

    public function test_set_input_is_validated(): void
    {
        $this->postJson('/api/sets', [
            'workout_session_id' => 999999,
            'exercise_id' => 999999,
            'weight' => -1,
            'reps' => 0,
            'rpe' => 11,
        ])->assertUnprocessable();
    }
}