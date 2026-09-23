<?php

namespace App\Http\Resources;

use App\Models\Set;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Set
 */
class SetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'workout_session_id' => $this->workout_session_id,
            'exercise_id' => $this->exercise_id,
            'weight' => $this->weight,
            'reps' => $this->reps,
            'rpe' => $this->rpe,
            'pr' => $this->pr,
            'is_warmup' => $this->is_warmup,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}