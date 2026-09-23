<?php

namespace Tests\Unit;

use App\Models\WorkoutLayout;
use App\Models\WorkoutSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkoutSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_workout_session_crud_endpoints(): void
    {
        $session = WorkoutSession::factory()->create();

        $this->getJson('/api/workout-sessions')->assertOk();
        $this->getJson("/api/workout-sessions/{$session->id}")->assertOk();
        $this->postJson('/api/workout-sessions', [
            'workout_layout_id' => WorkoutLayout::factory()->create()->id,
            'started_at' => '2026-09-23 08:00:00',
        ])->assertCreated();
        $this->patchJson("/api/workout-sessions/{$session->id}", [
            'workout_layout_id' => $session->workout_layout_id,
            'started_at' => $session->started_at->toDateTimeString(),
            'finished_at' => '2026-09-23 09:00:00',
            'notes' => 'Completed session',
        ])->assertOk();
        $this->deleteJson("/api/workout-sessions/{$session->id}")->assertNoContent();
    }

    public function test_workout_session_rejects_finished_before_started(): void
    {
        $this->postJson('/api/workout-sessions', [
            'workout_layout_id' => WorkoutLayout::factory()->create()->id,
            'started_at' => '2026-09-23 10:00:00',
            'finished_at' => '2026-09-23 09:00:00',
        ])->assertUnprocessable();
    }
}