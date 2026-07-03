<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\BodyMetric;

class BodyMetricTest extends BaseTestCase
{
    use RefreshDatabase;

    public function test_create_body_metric(): void
    {
        $measuredAt = now()->toIso8601String();

        $response = $this->postJson('/api/body-metrics', [
            'weight' => 85.50,
            'body_fat_percentage' => 18.50,
            'muscle_mass' => 40.00,
            'measured_at' => $measuredAt,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'data' => [
                         'weight' => 85.50,
                         'body_fat_percentage' => 18.50,
                         'muscle_mass' => 40.00,
                     ],
                 ]);
    }

    public function test_update_body_metric(): void
    {
        $measuredAt = now()->toIso8601String();

        $bodyMetric = BodyMetric::create([
            'weight' => 85.50,
            'body_fat_percentage' => 18.50,
            'muscle_mass' => 40.00,
            'measured_at' => $measuredAt,
        ]);

        $response = $this->putJson("/api/body-metrics/{$bodyMetric->id}", [
            'weight' => 84.00,
            'body_fat_percentage' => 17.80,
            'muscle_mass' => 41.20,
            'measured_at' => $measuredAt,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'weight' => 84.00,
                         'body_fat_percentage' => 17.80,
                         'muscle_mass' => 41.20,
                     ],
                 ]);
    }

    public function test_get_body_metric(): void
    {
        $measuredAt = now()->toIso8601String();

        $bodyMetric = BodyMetric::create([
            'weight' => 90.00,
            'body_fat_percentage' => 22.00,
            'muscle_mass' => 38.00,
            'measured_at' => $measuredAt,
        ]);

        $response = $this->getJson("/api/body-metrics/{$bodyMetric->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'id' => $bodyMetric->id,
                         'weight' => 90.00,
                         'body_fat_percentage' => 22.00,
                         'muscle_mass' => 38.00,
                     ],
                 ]);
    }

    public function test_get_body_metric_list(): void
    {
        $measuredAt = now()->toIso8601String();

        BodyMetric::create([
            'weight' => 75.00,
            'body_fat_percentage' => 14.00,
            'muscle_mass' => 35.00,
            'measured_at' => $measuredAt,
        ]);

        BodyMetric::create([
            'weight' => 76.20,
            'body_fat_percentage' => 14.50,
            'muscle_mass' => 35.80,
            'measured_at' => $measuredAt,
        ]);

        $response = $this->getJson('/api/body-metrics');

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }

    public function test_delete_body_metric(): void
    {
        $bodyMetric = BodyMetric::create([
            'weight' => 80.00,
            'body_fat_percentage' => 15.00,
            'muscle_mass' => 38.00,
            'measured_at' => now()->toIso8601String(),
        ]);

        $response = $this->deleteJson("/api/body-metrics/{$bodyMetric->id}");

        $response->assertStatus(204); // Using 204 No Content for standard API Resource updates
        $this->assertDatabaseMissing('body_metrics', ['id' => $bodyMetric->id]);
    }
}
