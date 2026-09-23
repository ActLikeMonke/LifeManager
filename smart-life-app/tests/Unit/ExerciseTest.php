<?php

namespace Tests\Unit;

use App\Models\Exercise;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExerciseTest extends TestCase
{
    use RefreshDatabase;

    public function test_exercise_crud_endpoints(): void
    {
        $exercise = Exercise::factory()->create();

        $this->getJson('/api/exercises')->assertOk();
        $this->getJson("/api/exercises/{$exercise->id}")->assertOk();
        $this->postJson('/api/exercises', [
            'name' => 'Barbell Squat',
            'muscle_group' => 'Legs',
        ])->assertCreated();
        $this->patchJson("/api/exercises/{$exercise->id}", [
            'name' => 'Front Squat',
            'muscle_group' => 'Legs',
        ])->assertOk();
        $this->putJson("/api/exercises/{$exercise->id}", [
            'name' => 'Back Squat',
            'muscle_group' => 'Legs',
        ])->assertOk();
        $this->deleteJson("/api/exercises/{$exercise->id}")->assertNoContent();
    }

    public function test_exercise_input_is_validated(): void
    {
        $this->postJson('/api/exercises', [
            'name' => '',
            'muscle_group' => str_repeat('x', 256),
        ])->assertUnprocessable();
    }
}