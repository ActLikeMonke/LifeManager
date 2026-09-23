<?php

namespace App\Models;

use Database\Factories\WorkoutLayoutFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutLayout extends Model
{
    /** @use HasFactory<WorkoutLayoutFactory> */
    use HasFactory;

    protected $table = 'workouts_layout';

    protected $fillable = [
        'name',
    ];
}