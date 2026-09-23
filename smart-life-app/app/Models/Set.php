<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_session_id',
        'exercise_id',
        'weight',
        'reps',
        'rpe',
        'pr',
        'is_warmup',
    ];

    protected function casts(): array
    {
        return [
            'weight' => 'decimal:2',
            'pr' => 'decimal:2',
            'is_warmup' => 'boolean',
        ];
    }

    public function workoutSession()
    {
        return $this->belongsTo(WorkoutSession::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}