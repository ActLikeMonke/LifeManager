<?php

namespace App\Http\Resources;

use App\Models\MealSession;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MealSession
 */
class MealSessionResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'eaten_at'   => $this->eaten_at, // Assuming eaten_at is cast to a datetime in your Model
            'notes'      => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'meal'       => new MealResource($this->whenLoaded('meal')), // Assuming you have a MealResource for the related meal
        ];
    }
}