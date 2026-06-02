<?php

namespace App\Http\Resources;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Meal
 */
class MealResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'meal_name' => $this->name,
            
            // Map through the foods relationship to include the pivot quantity
            'foods' => $this->whenLoaded('foods', function () {
                return $this->foods->map(function ($food) {
                    return [
                        'id' => $food->id,
                        'name' => $food->name, 
                        'quantity' => (float) $food->pivot->quantity, // Pulls from food_meal table
                    ];
                });
            }),
        ];
    }
}